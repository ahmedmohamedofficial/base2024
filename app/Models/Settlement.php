<?php

namespace App\Models;

use App\Enums\SettlementStatus;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Settlement extends BaseModel
{
	const IMAGEPATH = 'settlements';

	use UploadTrait;

	protected $fillable = [
		'providerable_id',
		'providerable_type',
		'settlement_num',
		'amount',
		'total_admin_commission',
		'status',
		'type',
		'image',
		'rejected_reason'
	];

	const searchAttributes = ['settlement_num', 'amount', 'total_admin_commission', 'type', 'rejected_reason', 'providerable.name', 'status'];


	public function providerable() : MorphTo
	{
		return $this->morphTo('providerable');
	}
	public function financialTransactions(): BelongsToMany
	{
		return $this->belongsToMany(FinancialTransaction::class, 'financial_transaction_settlements', 'settlement_id', 'financial_id');
	}

	public function getImagePathAttribute() {
		$image = $this->getImage($this->attributes['image'], 'settlements');
		return $image;
	}
	public function getImageAttribute() {
		return $this->attributes['image'];
	}


	public function getTypeTextAttribute()
	{
		return __('enums.settlements_type.'.$this->attributes['type']);
	}
	public function getStatusTextAttribute()
	{
		return SettlementStatus::toResource($this->attributes['status'], 'enums', 'settlements_status.')['title'];
	}

	public static function boot() {
		parent::boot();
		/* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

		static::deleted(function($model) {
			$model->deleteFile($model->attributes['image'], 'settlements');
		});
		self::creating(function ($model) {
			$lastId                = self::max('id') ?? 0;
			$model->settlement_num = date('Y') . ($lastId + 1);
		});

	}

}
