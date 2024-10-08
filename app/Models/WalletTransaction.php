<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletTransaction extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'type',
        'amount',
        'transactionable_id',
        'transactionable_type',
		'amount_before',
		'amount_after'
    ];

    public function getTypeTextAttribute($value)
    {
        return  __('admin.wallet_type_'.$this->attributes['type']) ;
    }

    

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }



    public function transactionable()
    {
        return $this->morphTo();
    }
}
