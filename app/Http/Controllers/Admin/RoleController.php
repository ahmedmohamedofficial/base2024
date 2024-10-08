<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MasterExport;
use App\Models\Role;
use App\Models\Permission;
use App\Traits\ReportTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Admin\Role\Create;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $roles = Role::search($request)->paginate(30);
            $html = view('admin.roles.table' ,compact('roles'))->render() ;
            return response()->json(['html' => $html]);
        }
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Create $request)
    {
        if(!$request->permissions){
            return back()->with('danger', 'يجب اختيار صلاحيه واحده علي الاقل ');
        }
        $role = Role::create($request->validated());
        // dd($request->permissions);
        $permissions = [];
        foreach ($request->permissions ?? [] as $permission)
            $permissions[]['permission'] = $permission;

        $role->permissions()->createMany($permissions);
        ReportTrait::addToLog('  اضافه صلاحية') ;
        return redirect(route('admin.roles.index'))->with('success', 'تم الاضافه بنجاح');
    }

    /***************************  get all roles  **************************/
    public function edit($id)
    {
        $role      = Role::findOrFail($id);
        $my_routes = Permission::where('role_id', $id)->pluck('permission')->toArray();

        return view('admin.roles.edit',get_defined_vars());
    }

    public function export(Request $request)
    {
        $records    = Role::search($request)->latest()->get();
        $folderName = 'roles';
        return Excel::download(new MasterExport($records, 'public-settings.' . $folderName . '-exel', ['rows' => $records]), $folderName . '-reports-' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }

    public function update(Create $request, $id)
    {
        if (!$request->permissions) {
            return back()->with('danger', 'يجب اختيار صلاحيه واحده علي الاقل ');
        }

        $role = Role::findOrFail($id);
        $role->update($request->validated());

        $role->permissions()->delete();
        $permissions = [];
        foreach ($request->permissions ?? [] as $permission)
            $permissions[]['permission'] = $permission;

        $role->permissions()->createMany($permissions);
        ReportTrait::addToLog('  تعديل صلاحية') ;

        return redirect(route('admin.roles.index'))->with('success', 'تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id)->delete();
        ReportTrait::addToLog('  حذف صلاحية') ;
        return response()->json(['id' =>$id]);
    }
}
