<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\settlements\Store;
use App\Models\Settlement;
use App\Services\Provider\FinancialTransactionService;
use App\Traits\ReportTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class SettlementController extends Controller
{
	public function index(Request $request)
	{
		$status = (new FinancialTransactionService())->getSettlementsStatusAdmin();
		if (request()->ajax()) {
			$settlements = Settlement::search($request)->paginate(30);
			$html = view('admin.settlements.table' ,compact('settlements'))->render() ;
			return response()->json(['html' => $html]);
		}
		return view('admin.settlements.index', compact('status'));
	}


	public function show($id)
	{
		$settlement = Settlement::findOrFail($id);
		$financialTransactions = $settlement->financialTransactions;
		return view('admin.settlements.show', get_defined_vars());
	}

	public function settlementChangeStatus(Store $request)
	{
		$settlement = Settlement::findOrFail($request->id);

		ReportTrait::addToLog('  بتغير حاله طلب التسوية') ;

		$response = (new FinancialTransactionService())->changeStatus($settlement, $request);

		return Response::json($response);
	}

}
