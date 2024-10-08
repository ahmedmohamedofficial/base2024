<?php

namespace  App\Services;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class CacheService {


	/** public function Settings **/
	public function Settings()
	{
		$settings               =   Cache::get('settings');
		if (empty($settings)){
			Cache::forget('settings');
			$settings           =   Cache::rememberForever('settings', function () {
				return SiteSetting::get()->pluck('value', 'key')->toArray();
			});
		}
		return !empty($settings) ? $settings : [];
	}





}
