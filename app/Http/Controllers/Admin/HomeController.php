<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Order;
use App\Models\Provider;
use App\Services\DashboardService;
use App\Services\Provider\FinancialTransactionService;
use Hash;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\UpdateProfile;
use App\Http\Requests\Admin\Auth\updatePassword;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{

	/***************** dashboard *****************/
	public function dashboard(DashboardService $dashboardService)
	{
//		$order = Order::find(205);
//		$financial = (new FinancialTransactionService())->createFinancialTransactions($order);
//		dd($financial);
		$provider = Provider::find(1);
		(new FinancialTransactionService())->addRequest($provider);
		$data = $dashboardService->DashboardData();
		return view('admin.dashboard.index', $data);
	}

	public function profile()
	{
		$countries = Country::get();
		return view('admin.admins.profile', compact('countries'));
	}


	public function updateProfile(UpdateProfile $request)
	{
		auth('admin')->user()->update($request->validated());
		return Response::json(['status' => 'success', 'msg' => __('admin.update_successfullay'), 'url' => URL::previous()]);
	}

	public function updatePassword(updatePassword $request)
	{
		if (!Hash::check($request->old_password, auth('admin')->user()->password)) {
			return back()->with('danger', __('admin.not_old_password'));
		}
		auth('admin')->user()->update(['password' => $request->password]);
		return back()->with('success', __('admin.update_successfullay'));
	}

	public function chartData($model)
	{
		$users      = $model::select('id', 'created_at')
			->get()
			->groupBy(function ($date) {
				return Carbon::parse($date->created_at)->format('Y-m');
			});
		$usermcount = [];
		$userArr    = [];

		foreach ($users as $key => $value) {
			$usermcount[$key] = count($value);
		}
		for ($i = 1; $i <= 12; $i++) {
			$d = ($i < 10) ? date('Y') . '-0' . $i : date('Y') . '-' . $i;
			if (!empty($usermcount[$d])) {
				$userArr[] = $usermcount[$d];
			} else {
				$userArr[] = 0;
			}
		}
		return $userArr;

	}
}
