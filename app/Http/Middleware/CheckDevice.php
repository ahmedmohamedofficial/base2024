<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckDevice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
		if (Auth::guard('admin')->check() && Session::has('admin_device_id')){
			if (!Auth::guard('admin')->user()->devices()->where('device_id', Session::get('admin_device_id'))->first()){
				Session::forget('admin_device_id');
			}
		}
        return $next($request);
    }
}
