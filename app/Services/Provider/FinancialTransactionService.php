<?php

namespace App\Services\Provider;

use App\Enums\FinancialTransactionStatus;
use App\Enums\OrderPayType;
use App\Enums\SettlementStatus;
use App\Models\Admin;
use App\Models\FinancialTransaction;
use App\Notifications\NotifyAdmin;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

class FinancialTransactionService
{
	use GeneralTrait;

	/**
	 * Create financial transactions for an order.
	 *
	 * @return FinancialTransaction The created financial transaction.
	 */
	public function createFinancialTransactions($order): FinancialTransaction
	{
		// Calculate the financial data for the order.
		$data = $this->calculateFinancial($order);

		// Create a new financial transaction for the order.
		return $order->financialTransactions()->updateOrCreate([
			'providerable_type' => $data['providerable_type'],
			'providerable_id'   => $data['providerable_id'],

		], $data);
	}

	private function calculateFinancial($order): array
	{
		$priceProducts   = $order->total_products - $order->coupon_amount;
		$commissionAdmin = $order->admin_commission;
		$totalVat        = $order->vat_amount;

		// Calculate due and indebtedness based on payment type
		if ($order->pay_type == OrderPayType::CASH) {
			$due          = 0;
			$indebtedness = $commissionAdmin;
		} else {
			$dueAmount    = $order->final_total - $commissionAdmin;
			$due          = max($dueAmount, 0);
			$indebtedness = max(-$dueAmount, 0);
		}

		// Calculate final price
		$finalPrice = $priceProducts + $totalVat;

		return [
			'order_price'       => $priceProducts,
			'commission_amount' => $commissionAdmin,
			'vat_amount'        => $totalVat,
			'final_price'       => $finalPrice,
			'due'               => $due,
			'indebtedness'      => $indebtedness,
			'providerable_type' => get_class($order->provider),
			'providerable_id'   => $order->provider_id,
		];
	}


	public function addRequest($provider)
	{
		// Start a database transaction
		DB::beginTransaction();
		try {
			$financialTransactions = $provider->financialTransactions()->where('status', FinancialTransactionStatus::NEW)->get();

			// Check if there are any new financial transactions for the provider
			if ($financialTransactions->isEmpty()) {
				return $this->responseFail(__('apis.some_thing_error'));
			}

			$totalPrice = $this->calculateTotalPrice($financialTransactions);
			$settlement = $this->createSettlement($provider, $totalPrice, $financialTransactions);

			// Associate the new settlement with the related financial transactions
			$settlement->financialTransactions()->sync($financialTransactions->pluck('id')->toArray());

			if ($totalPrice < 0) {
				$this->handleIndebtednessSettlement($settlement);
			} else {
				$this->handleDueSettlement($settlement);
			}

			DB::commit();
			return $this->responseSuccess($settlement, $totalPrice < 0 ? __('site.financial_payed_successfully') : __('site.financial_new_request_successfully_title'));

		} catch (\Exception $e) {
			// Roll back the database transaction in case of an exception
			DB::rollBack();
			// Log the error and return the error message
			return log_error($e);
		}
	}

	private function responseFail($message)
	{
		return ['key' => 'fail', 'msg' => $message];
	}

	private function responseSuccess($settlement, $message)
	{
		return [
			'key' => 'success',
			'msg' => $message,
			//			'url'   => route('center.settlements.show', $settlement->id),
			//			'modal' => $message === __('site.financial_new_request_successfully_title') ? '#financial-transactions' : null
		];
	}

	private function calculateTotalPrice($financialTransactions)
	{
		return $financialTransactions->sum('due') - $financialTransactions->sum('indebtedness');
	}

	private function createSettlement($provider, $totalPrice, $financialTransactions)
	{
		return $provider->settlements()->create([
			'amount'                 => abs($totalPrice),
			'total_admin_commission' => $financialTransactions->sum('commission_amount'),
			'type'                   => $totalPrice < 0 ? 'indebtedness' : 'due',
		]);
	}

	private function handleIndebtednessSettlement($settlement)
	{
//		$settlement->update(['status' => 'waiting_pay']);
		$settlement->update(['status' => 'payed']);
//		$settlement->financialTransactions()->update(['status' => FinancialTransactionStatus::PENDING]);
		$settlement->financialTransactions()->update(['status' => FinancialTransactionStatus::ACCEPTED]);
		$typeNotify = $settlement->type == 'due' ? 'new_settlement' : 'settlement_payed';
		$this->notifyAdmin($settlement, $typeNotify);
	}

	private function handleDueSettlement($settlement)
	{
		$settlement->financialTransactions()->update(['status' => FinancialTransactionStatus::PENDING]);
		$this->notifyAdmin($settlement, 'new_settlement');
	}

	private function notifyAdmin($settlement, $type)
	{
		$dataNotify = [
			'type'           => $type,
			'url'            => route('admin.settlements.show', $settlement->id),
			'settlement_num' => $settlement->settlement_num
		];
		Notification::send(Admin::get(), new NotifyAdmin($dataNotify));
	}

	public function getSettlements($provider, $request, $paginateNum)
	{
		return match ($request->segment(3)) {
			'new-settlements'       => $provider->settlements()->latest()->whereIn('status', ['pending', 'waiting_pay'])->paginate($paginateNum),
			'completed-settlements' => $provider->settlements()->latest()->whereIn('status', ['accepted', 'payed', 'rejected', 'cancelled'])->paginate($paginateNum),
		};
	}

	public function paySettlement($settlement, $request)
	{
		// Start a database transaction
		DB::beginTransaction();
		try {
			if ($settlement->status === 'waiting_pay') {
				if ($request->status === 'sight') {
					return $this->handlePayment($settlement);
				}

				if ($request->status === 'reject') {
					return $this->handleRejection($settlement);
				}
			}

			// Return the fail message
			return $this->responseFail(__('apis.some_thing_error'));
		} catch (\Exception $e) {
			// Roll back the database transaction in case of an exception
			DB::rollBack();
			// Log the error and return the error message
			return log_error($e);
		}
	}

	private function handlePayment($settlement)
	{
		$settlement->update(['status' => 'payed']);
		$settlement->financialTransactions()->update(['status' => FinancialTransactionStatus::ACCEPTED]);

		$this->notifyAdmin($settlement, 'settlement_payed');

		// Commit the database transaction
		DB::commit();

		return $this->responseSuccess($settlement, __('site.financial_payed_successfully'));
	}

	private function handleRejection($settlement)
	{
		$settlement->update(['status' => 'cancelled']);
		$settlement->financialTransactions()->update(['status' => FinancialTransactionStatus::NEW]);

		$this->notifyAdmin($settlement, 'settlement_cancelled');

		// Commit the database transaction
		DB::commit();

		return $this->responseSuccess($settlement, __('site.financial_cancelled_successfully'));
	}

	/**
	 * Change the status of a settlement and its associated financial transactions.
	 *
	 */
	public function changeStatus($settlement, $request)
	{
		// Begin a database transaction
		DB::beginTransaction();

		try {
			// Update the status of the settlement
			$settlement->update($request->validated());

			// Update the status of financial transactions based on the request status
			$this->updateFinancialTransactionsStatus($settlement, $request->status);

			// Prepare and send notification
			$this->notifyProvider($settlement, $request->status);

			// Commit the database transaction
			DB::commit();

			// Return success response with message and URL
			return $this->responseSuccessAdmin($settlement);

		} catch (\Exception $e) {
			// Roll back the database transaction in case of an exception
			DB::rollBack();

			// Log the error and return the error message
			return $this->responseFailAdmin($e);
		}
	}


	private function updateFinancialTransactionsStatus($settlement, $status)
	{
		$transactionStatus = $status === 'rejected' ? FinancialTransactionStatus::NEW : FinancialTransactionStatus::ACCEPTED;
		$settlement->financialTransactions()->update(['status' => $transactionStatus]);
	}

	private function notifyProvider($settlement, $status)
	{
		$dataNotify = [
			'type'           => $status === 'rejected' ? 'settlement_rejected' : 'settlement_accepted',
			'url'            => route('admin.settlements.show', $settlement->id),
			'settlement_num' => $settlement->settlement_num
		];

		$settlement->providerable?->notify(new NotifyAdmin($dataNotify));
	}

	private function responseSuccessAdmin($settlement): array
	{
		return [
			'status' => 'success',
			'msg'    => __('admin.financial_changed_successfully'),
			'url'    => URL::previous()
		];
	}

	private function responseFailAdmin($e): array
	{
		log_error($e);
		return [
			'status' => 'fail',
			'msg'    => __('apis.some_thing_error')
		];
	}

	public function getSettlementsStatusAdmin()
	{
		$status = [];
		foreach (SettlementStatus::withTitle('enums', 'settlements_status.') as $key => $value) {
			$status[$key] = [
				'name' => $value['title'],
				'id'   => $value['id']
			];
		}
		return $status;
	}
}
