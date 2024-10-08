<?php

namespace  App\Services\User;

use App\Traits\ResponseTrait;
use App\Enums\WalletTransaction;
use App\Enums\PaymentTransactions;
use Illuminate\Support\Facades\DB;
use App\Services\PaymentGateway\PaymentService;

class WalletService {
    
    use ResponseTrait;
    /**
     * Charge the user's wallet online.
     *
     * @param  array  $request The request data.
     * @param  User   $user    The user object.
     * @return mixed           The response data.
    */
    public function chargeWalletOnline($request, $user)
    {
        // Create a new instance of the PaymentService class
        $paymentService = new PaymentService();

        // Create the payment
        $payment = $paymentService->create()->createPayment($request, $user);

        // Create the payment transaction
        $transaction = $paymentService->createPaymentTransaction(
            $request['amount'],
            PaymentTransactions::CHARGEWALLET,
            'App\Models\Wallet',
            $user->wallet->id,
            $payment['transaction_id'],
            $payment['paymentResponse'],
            $payment['payment_name']
        );
        // Check if the request is an API request
        if (request()->is('api/*')) {
            return $this->successData([
                'redirect_url' => $payment['redirect_url']
            ]);
        } else {
            return redirect()->to($payment['redirect_url']);
        }
    }


    function charge($wallet , $balance) {
		$oldBalance = $wallet->balance;
		$wallet->update([
			'balance' =>  DB::raw('balance + '.$balance),
			'available_balance' =>  DB::raw('available_balance + '.$balance),
		]);
		$wallet->refresh();
		$wallet->transactions()->create([
			'type'   => WalletTransaction::CHARGE,
			'amount' => $balance,
			'amount_before' => $oldBalance,
			'amount_after' => $wallet->balance
		]);
    }

    function debt($wallet , $balance) {
		$oldBalance = $wallet->balance;
		$wallet->update([
			'balance' =>  DB::raw('balance - '.$balance),
			'available_balance' =>  DB::raw('available_balance - '.$balance),
		]);

		$wallet->refresh();
		$wallet->transactions()->create([
			'type'   => WalletTransaction::DEBT,
			'amount' => $balance,
			'amount_before' => $oldBalance,
			'amount_after' => $wallet->balance
		]);
        return ;
    }


    


}
