<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Traits\ReportTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pages\Update;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $pages = Page::search($request)->paginate(30);
            $html  = view('admin.pages.table', compact('pages'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.pages.index');
    }

    public function edit($id)
    {
        $pages = Page::findOrFail($id);
        return view('admin.pages.edit', ['pages' => $pages]);
    }

    public function update(Update $request, $id)
    {
        Page::findOrFail($id)->update($request->validated());
        ReportTrait::addToLog('  تعديل صفحة');
        return response()->json(['status' => 'success', 'msg' => __('admin.update_successfully'), 'url' => route('admin.pages.index')]);
    }

    public function show($id)
    {
        $pages = Page::findOrFail($id);
        return view('admin.pages.show', ['pages' => $pages]);
    }
}
