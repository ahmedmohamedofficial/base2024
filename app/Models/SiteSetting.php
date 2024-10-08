<?php

namespace App\Models;

use App\Traits\UploadTrait;

class SiteSetting extends BaseModel
{

	use UploadTrait;
	protected $fillable = ['key', 'value'];

	public $images = [
		'logo', 'fav_icon', 'login_background','no_data_icon','default_user',
		'intro_logo','intro_loader','about_image_2', 'about_image_1'
	];

	public function getValueAttribute()
	{
		$key = $this->attributes['key'];
		return in_array($key, $this->images) ? '/storage/images/settings/' . $this->attributes['value'] : $this->attributes['value'];
	}
	protected function setValueAttribute($value)
	{
		$key = $this->attributes['key'];
		if (in_array($key, $this->images)){
			if ($value != NULL && is_file($value)){
				$this->attributes['value'] = $this->uploadAllTyps($value, 'settings');
			}

		}else{
			$this->attributes['value'] = $value;
		}


	}
}
