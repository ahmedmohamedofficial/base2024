<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MasterExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Copy\Store;
use App\Http\Requests\Admin\Copy\Update;
use App\Models\Copy;
use App\Traits\ReportTrait;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;


class CopyController extends Controller
{
	public function index(Request $request)
	{
		if (request()->ajax()) {
			$copys = Copy::search($request)->paginate(30);
			$html  = view('admin.copys.table', compact('copys'))->render();
			return response()->json(['html' => $html]);
		}
		return view('admin.copys.index');
	}

	public function create()
	{
		return view('admin.copys.create');
	}


	public function store(Store $request)
	{
		Copy::create($request->validated());
		ReportTrait::addToLog('  اضافه arsinglesame');
		return response()->json(['status' => 'success', 'msg' => __('admin.added_successfully'), 'url' => route('admin.copys.index')]);
	}

	public function edit($id)
	{
		$copy = Copy::findOrFail($id);
		return view('admin.copys.edit', ['copy' => $copy]);
	}

	public function update(Update $request, $id)
	{
		$copy = Copy::findOrFail($id)->update($request->validated());
		ReportTrait::addToLog('  تعديل arsinglesame');
		return response()->json(['status' => 'success', 'msg' => __('admin.update_successfully'), 'url' => route('admin.copys.index')]);
	}

	public function show($id)
	{
		$copy = Copy::findOrFail($id);
		return view('admin.copys.show', ['copy' => $copy]);
	}

	public function destroy($id)
	{
		$copy = Copy::findOrFail($id)->delete();
		ReportTrait::addToLog('  حذف arsinglesame');
		return response()->json(['id' => $id]);
	}

	public function destroyAll(Request $request)
	{
		$requestIds = json_decode($request->data);

		foreach ($requestIds as $id) {
			$ids[] = $id->id;
		}
		if (Copy::WhereIn('id', $ids)->get()->each->delete()) {
			ReportTrait::addToLog('  حذف العديد من arpluraleName');
			return response()->json('success');
		} else {
			return response()->json('failed');
		}
	}

	public function export(Request $request)
	{
		$records    = Copy::search($request)->get();
		$folderName = 'copys';
		return Excel::download(new MasterExport($records, $folderName . '-exel', ['rows' => $records]), $folderName . '-reports-' . Carbon::now()->format('Y-m-d') . '.xlsx');
	}
}
