<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\User\WalletService;

class WalletController extends Controller
{
    use ResponseTrait ; 


    public function show(){
        $wallet = auth()->user()->wallet ;
        return $this->successData([
            'balance'           => (float) $wallet->balance ,
            'available_balance' => (float) $wallet->available_balance,
            'pending_balance'   => (float) $wallet->pending_balance ,
        ]);
    }


    function charge(Request $request){
       return (new WalletService())->chargeWalletOnline($request->all() , auth()->user());
    }
}
