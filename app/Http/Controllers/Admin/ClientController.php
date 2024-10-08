<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendNotificationJob;
use App\Models\Country;
use DB ;
use App\Models\User;
use App\Models\Order;
use App\Models\Complaint;
use App\Traits\ReportTrait;
use Illuminate\Http\Request;
use App\Notifications\BlockUser;
use App\Http\Controllers\Controller;
use App\Services\User\WalletService;
use App\Http\Requests\Admin\Client\Store;
use App\Http\Requests\Admin\Client\Update;
use Illuminate\Support\Facades\Notification;
use App\Models\WalletTransaction as WalletTransactionModel;
use Illuminate\Support\Facades\URL;

class ClientController extends Controller {

    public function index(Request $request) {
        if (request()->ajax()) {
            $rows = User::search($request)->paginate(30);
            $html = view('admin.clients.table', compact('rows'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.clients.index');
    }

    public function create() {
		$countries = Country::get();
		return view('admin.clients.create', compact('countries'));
    }

    public function store(Store $request) {
        User::create($request->validated());
        ReportTrait::addToLog('  اضافه مستخدم');
        return response()->json(['status'=>'success', 'msg'=>__('admin.added_successfully'),'url' => route('admin.clients.index')]);
    }

    public function edit($id) {
        $row = User::findOrFail($id);
        return view('admin.clients.edit', ['row' => $row]);
    }

    public function update(Update $request, $id) {
        $user = User::findOrFail($id)->update($request->validated());
        ReportTrait::addToLog('  تعديل مستخدم');
        return response()->json(['status'=>'success', 'msg'=>__('admin.update_successfully'),'url' => route('admin.clients.index')]);
    }

    public function showfinancial($id) {
        $complaints = Complaint::where('user_id', $id)->paginate(10);
        return view('admin.complaints.user_complaints', ['complaints' => $complaints]);
    }

    public function showorders($id) {
        $orders = Order::where('user_id', $id)->paginate(10);
        return view('admin.clients.orders', ['orders' => $orders]);
    }


    public function destroy($id) {
        $user = User::findOrFail($id)->delete();
        ReportTrait::addToLog('  حذف مستخدم');
        return response()->json(['id' => $id]);
    }

    public function block(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update(['is_blocked' => !$user->is_blocked]);
        if ($user->refresh()->is_blocked == 1) {
            Notification::send($user, new BlockUser($request->all()));
        }
        return response()->json(['message' => $user->refresh()->is_blocked == 1 ? __('admin.blocked') :  __('admin.unblocked')]);
    }


	public function notify(Request $request)
	{
		$userIds = ('all' == $request->id) ? 'all' : explode(',', $request->id);

		SendNotificationJob::dispatch($request->all(), $userIds);

		return response()->json(['status' => 'success', 'msg' => __('admin.notifications_sent'), 'url' => URL::previous()]);
	}


	public function destroyAll(Request $request) {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (User::whereIn('id', $ids)->get()->each->delete()) {
            ReportTrait::addToLog('  حذف العديد من المستخدمين');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }


    function updateBalance(Request $request , $id) {
        $user = User::findOrFail($id);

		if ( $request->type == 0 ) {
			( new WalletService() )->charge( $user->wallet, (double)$request->balance );
		} else {
			( new WalletService() )->debt( $user->wallet, (double)$request->balance );
		}

        return response()->json(['msg' => __('admin.balance_updated') , 'balance' => $user->refresh()->wallet->balance . ' ' . __('site.currency')]);
    }


    public function show($id) {
        $row = User::findOrFail($id);

        if (request()->ajax()) {
            
            if (request()->type == 'main_data') {
                $html = view('admin.clients.parts.main_data', compact('row'))->render();
            }

            if (request()->type == 'complaints') {
                $complaints = Complaint::where('user_id', $id)->paginate(10);
                $html = view('admin.clients.parts.complaints', compact('complaints'))->render();
            }
            if (request()->type == 'wallet') {
                $transactions = WalletTransactionModel::where('wallet_id', $row->wallet->id)->paginate(10);
                $html = view('admin.clients.parts.transactions', compact('transactions'))->render();
            }

            return response()->json(['html' => $html]);
        }
        return view('admin.clients.show', ['row' => $row]);
    }
}