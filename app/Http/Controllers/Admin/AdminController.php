<?php
namespace App\Http\Controllers\Admin;
use App\Models\Country;
use App\Models\Role;
use App\Models\Admin;
use App\Traits\ReportTrait;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Notifications\BlockUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\Create;
use App\Http\Requests\Admin\Admin\Update;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
	use ResponseTrait;

	public function index(Request $request)
	{
		if (request()->ajax()) {
			$admins = Admin::where('type', 'admin')->search($request)->paginate(30);
			$html   = view('admin.admins.table', compact('admins'))->render();
			return response()->json(['html' => $html]);
		}
		return view('admin.admins.index');
	}

	public function create()
	{
		$roles     = Role::latest()->get();
		$countries = Country::get();
		return view('admin.admins.create', get_defined_vars());
	}

	public function store(Create $request)
	{
		Admin::create($request->validated());
		ReportTrait::addToLog('اضافه مدير');
		return $this->successOtherData(['status' => 'success', 'msg' => __('admin.added_successfully'), 'url' => route('admin.admins.index')]);
	}

	public function edit($id)
	{
		$admin = Admin::findOrFail($id);
		$roles = Role::latest()->get();
		$countries = Country::get();
		return view('admin.admins.edit', get_defined_vars());
	}

	public function update($id, Update $request)
	{
		$admin = Admin::findOrFail($id);
		$admin->update($request->validated());
		ReportTrait::addToLog('تعديل مدير');
		return $this->successOtherData(['status' => 'success', 'msg' => __('admin.update_successfully'), 'url' => route('admin.admins.index')]);
	}

	public function show($id)
	{
		$admin = Admin::findOrFail($id);
		$roles = Role::latest()->get();
		return view('admin.admins.show', ['admin' => $admin, 'roles' => $roles]);
	}

	public function destroy($id)
	{
		if (1 == $id) {
			return;
		}

		Admin::findOrFail($id)->delete();
		ReportTrait::addToLog('  حذف مدير');
		return $this->successOtherData(['id' => $id]);

	}

	public function destroyAll(Request $request)
	{
		$requestIds = array_column(json_decode($request->data), 'id');
		Admin::whereIn('id', $requestIds)->where('id', '!=', 1)->get()->each->delete();
		ReportTrait::addToLog('  حذف العديد من المديرين');
		return response()->json('success');
		//return response()->json('failed');
	}

	public function notifications()
	{
		auth('admin')->user()->unreadNotifications->markAsRead();
		return view('admin.admins.notifications');
	}

	public function deleteNotifications(Request $request)
	{
		$requestIds = array_column(json_decode($request->data), 'id');
		auth('admin')->user()->notifications()->whereIn('id', $requestIds)->delete();
		return $this->successMsg();
	}


	public function block(Request $request)
	{
		$admin = Admin::findOrFail($request->id);
		$admin->update(['is_blocked' => !$admin->is_blocked]);
		Notification::send($admin, new BlockUser($request->all()));
		return response()->json(['message' => $admin->refresh()->is_blocked == 1 ? __('admin.client_blocked') : __('admin.client_unblocked')]);
	}
}
