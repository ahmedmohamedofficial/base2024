<?php 

namespace App\Services\PaymentGateway;

use Illuminate\Http\Request;
use App\Enums\PaymentTransactions;
use App\Models\PaymentTransaction;
use App\Enums\WalletTransaction;

class PaymentService
{
    /**
     * Factory method to create a payment service instance.
     *
     * @return MyfatoorahService|HyperpayService|ClickpayService|AlrajhibankService|
     *         PaymobService|PaypalService|StripeService|TelrService
    */
    public static function create()
    {
        // Uncomment the line corresponding to the desired payment service.
//         return new MyfatoorahService;
        return new HyperpayService ;
        // return new ClickpayService ; 
        // return new AlrajhibankService ; 
        // return new PaymobService ; 
        // return new PaypalService ; 
        // return new StripeService ; 
        // return new TelrService ; 
    }

    function createPaymentTransaction($amount,$type , $transactionable_type , $transactionable_id , $transaction_id , $payemtResponse ,$paymentName ) {

        PaymentTransaction::create([
            'payment_getaway'  => $paymentName,
            'transaction_id'   => $transaction_id,
            'type'             => $type,
            'amount'           => $amount ,
            'currency_code'    => 'SAR',
            'status'           => 'pending',
            'getaway_response' => $payemtResponse,
            'trans_type'       => $transactionable_type,
            'trans_id'         => $transactionable_id ,
        ]);
    }


    /**
     * This function handles the callback from the payment service.
     * It uses the appropriate service class based on the payment service used.
     *
     * @param Request $request The request object containing paymentId
     * @return mixed The result of the checkPayment function
    */
    public static function callback(Request $request , $brand_id = null)
    {
        // Select the appropriate service class based on the payment service used
//        $serviceClass = new MyfatoorahService();
        $serviceClass = new HyperpayService() ;
        // return new ClickpayService ; 
        // return new AlrajhibankService ; 
        // return new PaymobService ; 
        // return new PaypalService ; 
        // return new StripeService ; 
        // return new TelrService ;

        // Get the payment status using the selected service class
        $data = $serviceClass->getPaymentStatus($request->paymentId , $brand_id);
        // Check the payment status and return the result
        return PaymentService::checkPayment($data);
    }


    /**
     * Check the payment status and update the transaction accordingly.
     *
     * @param array $data The payment data.
     * @return \Illuminate\Contracts\View\View The view for the payment status.
    */
    public static function checkPayment($data)
    {
        // Retrieve the payment transaction.
        $transaction = PaymentTransaction::where(
            'transaction_id', $data['transaction_id']
        )->firstOrFail();

        // If payment status is false, return failed view.
        if ($data['status'] == false) {
            $transaction->update([
                'status' =>  'failed'
            ]);
            return view('payment.failed', [
                'trans_id' => $data['transaction_id'],
                'status' => $data['status']
            ]);
        }


        // Update the transaction status.
        $transaction->update([
            'status' => 'completed'
        ]);

        // If transaction type is CHARGEWALLET, charge the wallet.
        if ($transaction->type == PaymentTransactions::CHARGEWALLET) {
            PaymentService::chargeWallet($transaction);
        }

        // Return the success view.
        return view('payment.success', [
            'trans_id' => $data['transaction_id'],
            'status' => $data['status']
        ]);
    }

    /**
     * Charge the wallet with a transaction amount.
     *
     * @param  object  $transaction
     * @return void
    */
    static function chargeWallet($transaction) {
        // Get the wallet from the transaction
        $wallet = $transaction->trans; 

        // Update the balance and available balance in the wallet
        $wallet->update([
            'balance'           => $transaction->amount +  $transaction->trans->balance, 
            'available_balance' => $transaction->amount +  $transaction->trans->available_balance, 
        ]);

        $wallet->transactions()->create([
            'type'                  =>  WalletTransaction::CHARGE,
            'transactionable_type'  =>  $transaction->trans_type,
            'transactionable_id'    =>  $transaction->trans_id,
            'amount'                =>  $transaction->amount,
        ]);

        // Return nothing
        return ;
    }
}
