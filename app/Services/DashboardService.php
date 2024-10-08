<?php

namespace App\Services;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Traits\MenuTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardService
{

	use MenuTrait;

	public function DashboardData()
	{
		Hijri::setLang(lang());

		$menus  = $this->home();
		$menus2 = $this->home2();

		$dataHijri            = Hijri::Date('j F  Y');
		$start                = Carbon::now()->subMonths(5);
		$end                  = Carbon::now();
		$colores              = ['info', 'danger', 'warning', 'success', 'primary'];
		$notActiveUsers       = User::where('is_active', 0)->count();
		$activeUsers          = User::where('is_active', 1)->count();
		$blockedUsers         = User::where('is_blocked', 1)->count();
		$nonBlockedUsers      = User::where('is_blocked', 0)->count();
		$usersCountMonths     = User::query()
			->select(DB::raw('DATE_FORMAT(created_at, "%m") AS month'), DB::raw('COUNT(id) as count'))
			->whereBetween('created_at', [$start, $end])
			->groupBy('month')->get();
		$data = [
			'dataHijri'              => $dataHijri,
			'usersMonths'          => $this->getMonths($usersCountMonths, $start, $end),
			'menus'                  => $menus,
			'menu2'                  => $menus2,
			'colores'                => $colores,
			'notActiveUsers'         => $notActiveUsers,
			'activeUsers'            => $activeUsers,
			'blockedUsers'           => $blockedUsers,
			'nonBlockedUsers'        => $nonBlockedUsers,
			'userCount'              => User::count(),
			'countryArray'           => $this->chartData(new Country),
			'cityArray'              => $this->chartData(new City()),
		];

		return $data;
	}

	public function getMonths($model, $start, $end)
	{

		$months = [];
		for ($i = 0; $i <= $start->diffInMonths($end); $i++) {
			$months[] = $start->copy()->addMonths($i)->format('m');
		}
		$monthsArray         = $model->pluck('month')->toArray();
		$countArray          = $model->pluck('count')->toArray();
		$monthsAndTotalArray = array_combine($monthsArray, $countArray);
		$values              = [];
		foreach ($months as $key => $month) {
			if (in_array($month, $monthsArray)) {
				$values[$key] = $monthsAndTotalArray[$month];
			} else {
				$values[$key] = 0;
			}

		}
		return $values;
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

	private function getOrdersChart($status)
	{
		return DB::table('orders')
			->select(DB::raw('DATE_FORMAT(created_at, "%m") AS month'), DB::raw('COUNT(id) as count'))
			->where('status', $status)->groupBy('month')->get();
	}
	private function getValuesChart($countOrders)
	{
		$start  = Carbon::parse('2023-01-01');
		$end    = Carbon::parse('2023-12-01');
		$months = [];
		for ($i = 0; $i <= $start->diffInMonths($end); $i++) {
			$months[] = $start->copy()->addMonths($i)->format('m');
		}
		$monthsArray         = $countOrders->pluck('month')->toArray();
		$countArray          = $countOrders->pluck('count')->toArray();
		$monthsAndTotalArray = array_combine($monthsArray, $countArray);
		$values              = [];
		foreach ($months as $key => $month) {
			if (in_array($month, $monthsArray)) {
				$values[$key] = $monthsAndTotalArray[$month];
			} else {
				$values[$key] = 0;
			}

		}
		return $values;
	}

}