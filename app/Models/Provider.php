<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;

class Provider extends AuthBaseModel
{
	const IMAGEPATH = 'providers';

	const searchAttributes = ['name', 'phone', 'email'];

	protected $casts = [
		'lat'        => 'decimal:8',
		'lng'        => 'decimal:8',
		'is_notify'  => 'boolean',
		'is_blocked' => 'boolean',
		'is_active'  => 'boolean',
	];

	protected $fillable = [
		'name',
		'country_code',
		'phone',
		'email',
		'password',
		'avatar',
		'is_active',
		'is_blocked',
		'is_approved',
		'code',
		'code_expire',
	];

	public function orders()
	{
		return $this->hasMany(Order::class, 'user_id', 'id');
	}
	public function financialTransactions ()
	{
		return $this->morphOne(FinancialTransaction::class, 'providerable');
	}

	public function settlements() : MorphMany
	{
		return $this->morphMany(Settlement::class, 'providerable');
	}

}
