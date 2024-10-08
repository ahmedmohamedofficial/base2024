<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\countries\Store;
use App\Http\Requests\Admin\countries\Update;
use App\Models\Country;
use App\Traits\ReportTrait;
use Illuminate\Support\Facades\DB;


class CountryController extends Controller
{
	public function index(Request $request)
	{
		if (request()->ajax()) {
			$countries = Country::search($request)->paginate(30);
			$html      = view('admin.countries.table', compact('countries'))->render();
			return response()->json(['html' => $html]);
		}
		return view('admin.countries.index');
	}

	public function create()
	{
		return view('admin.countries.create');
	}

	public function store(Store $request)
	{
		$validated = $request->validated();
		$validated['iso3'] = DB::table('iso_codes')->where('iso2', $request->iso2)->value('iso3');
		Country::create($validated);
		ReportTrait::addToLog('  اضافه بلد');
		return response()->json(['status' => 'success', 'msg' => __('admin.added_successfully'), 'url' => route('admin.countries.index')]);
	}

	public function edit($id)
	{
		$country = Country::findOrFail($id);
		return view('admin.countries.edit', ['country' => $country]);
	}

	public function update(Update $request, $id)
	{
		$validated = $request->validated();
		$validated['iso3'] = DB::table('iso_codes')->where('iso2', $request->iso2)->value('iso3');
		Country::findOrFail($id)->update($validated);
		ReportTrait::addToLog('  تعديل بلد');
		return response()->json(['status' => 'success', 'msg' => __('admin.update_successfully'), 'url' => route('admin.countries.index')]);
	}

	public function show($id)
	{
		$country = Country::findOrFail($id);
		return view('admin.countries.show', ['country' => $country]);
	}

	public function destroy($id)
	{
		$country = Country::findOrFail($id)->delete();
		ReportTrait::addToLog('  حذف بلد');
		return response()->json(['id' => $id]);
	}

	public function destroyAll(Request $request)
	{
		$requestIds = json_decode($request->data);

		foreach ($requestIds as $id) {
			$ids[] = $id->id;
		}
		if (Country::WhereIn('id', $ids)->get()->each->delete()) {
			ReportTrait::addToLog('  حذف العديد من البلاد');
			return response()->json('success');
		} else {
			return response()->json('failed');
		}
	}
}
