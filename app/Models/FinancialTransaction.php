<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class FinancialTransaction extends BaseModel
{
	use HasFactory;

	protected $fillable = [
		'orderable_id',
		'orderable_type',
		'providerable_id',
		'providerable_type',
		'order_price',
		'commission_amount',
		'vat_amount',
		'final_price',
		'due',
		'indebtedness',
		'status'
	];

	public function orderable() : MorphTo
	{
		return $this->morphTo('orderable');
	}

	public function providerable() : MorphTo
	{
		return $this->morphTo('providerable');
	}
}
