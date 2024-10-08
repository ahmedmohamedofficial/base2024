<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Enums\OrderPayType;
use App\Enums\OrderPayStatus;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Order extends BaseModel
{
    use UploadTrait;


    const searchAttributes = ['order_num'];

    protected $fillable = [
        'order_num', // auto with creating in this boot method
        'type',
        'user_id',
        'provider_id',
        'coupon_id',
        'coupon_num',
        'coupon_type',
        'coupon_value',
        'vat_per',

        'total_products',
        'coupon_amount',
        'vat_amount',
        'deliver_price',
        'final_total',

        'admin_commission_per',
        'admin_commission',

        'status',

        'pay_type',
        'pay_status',
        'pay_data',

        'lat',
        'lng',
        'map_desc',
        'notes',

        'user_delete',
        'provider_delete',
        // 'delegate_delete',
        'admin_delete',
    ];

    protected $casts = [
        'pay_data' => 'array',
        'lat'      => 'decimal:8',
        'lng'      => 'decimal:8',
    ];


    public function getTypeTextAttribute()
    {
        return trans('order.types_' . OrderType::slug($this->type));
    }

    public function getStatusTextAttribute()
    {
        return trans('order.status_' . OrderStatus::slug($this->status));
    }

    public function getPayTypeTextAttribute()
    {
        return trans('order.pay_type_' . OrderPayType::slug($this->pay_type));
    }

    public function getPayStatusTextAttribute()
    {
        return trans('order.pay_status_' . OrderPayStatus::slug($this->pay_status));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function provider() : BelongsTo
	{
		return $this->belongsTo(Provider::class);
	}

    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

    public function offers()
    {
        //return $this->hasMany(Offer::class);
    }

    public function acceptedOffer()
    {
        //return $this->belongsTo(Offer::class, 'accepted_offer_id');
    }
	public function financialTransactions () : MorphOne
	{
		return $this->morphOne(FinancialTransaction::class, 'orderable');
	}

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $lastId           = self::max('id') ?? 0;
            $model->order_num = date('Y') . ($lastId + 1);
        });
    }

}
