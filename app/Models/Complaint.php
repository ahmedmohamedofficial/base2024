<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\MorphTo;

class Complaint extends BaseModel
{

	const searchAttributes = ['user_name', 'phone', 'email'];
	protected $fillable = ['user_name', 'user_id', 'complaint', 'phone', 'email'];

	public function complaintable() : MorphTo
	{
		return $this->morphTo();
	}

	public function replays()
	{
		return $this->hasMany(ComplaintReplay::class, 'complaint_id', 'id');
	}
}
