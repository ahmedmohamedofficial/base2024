<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_getaway',
        'transaction_id',
        'type',
        'amount',
        'currency_code',
        'status',
        'getaway_response',
        'trans_type',
        'trans_id',
    ];
    

    public function trans() {
        return $this->morphTo();
    }




}
