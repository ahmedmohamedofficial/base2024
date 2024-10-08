<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Traits\ReportTrait;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class SettingController extends Controller
{
	public function index()
	{
		return view('admin.settings.index');
	}

	public function update(SettingRequest $request)
	{
		// Validate the incoming request data
		$validatedData = $request->validated();

		// If the type_setting is 'app_setting', convert 'is_production' to 1 or 0 based on existence
		if ($request->type_setting === 'app_setting') {
			$validatedData['is_production'] = isset($validatedData['is_production']) ? 1 : 0;
		}

		// Clear the 'settings' cache
		Cache::forget('settings');

		// Iterate through the validated data and update or create SiteSetting entries
		foreach ($validatedData as $key => $value) {
			if ($value !== null) {
				$setting = SiteSetting::firstOrCreate(
					['key' => $key],
					['value' => $value]
				);

				// If the setting was not recently created, update its value
				if (!$setting->wasRecentlyCreated) {
					$setting->update(['value' => $value]);
				}
			}
		}

		// Add a log entry for the setting modification
		ReportTrait::addToLog('تعديل الاعدادت');

		// Return a JSON response with success status, message, and previous URL
		return Response::json(['status' => 'success', 'msg' => __('admin.saved_successfully'), 'url' => URL::previous()]);
	}


	public function messageAll(Request $request, $type)
	{

		$this->userRepo->messageAll($request->all(), $type);
		return back()->with('success', 'تم الارسال');
	}

	public function messageOne(Request $request, $type)
	{

		$this->userRepo->messageOne($request->all(), $type);
		return back()->with('success', 'تم الارسال');
	}

	public function sendEmail(Request $request)
	{

		$this->settingRepo->sendEmail($request->all());
		return back()->with('success', 'تم الارسال');
	}
}
