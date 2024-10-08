<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\loginRequest;
use App\Models\SiteSetting;
use App\Services\SettingService;
use App\Traits\AdminFirstRouteTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  use AdminFirstRouteTrait;
  public function SetLanguage($lang)
  {
    if (in_array($lang, ['ar', 'en'])) {

      if (session()->has('lang')) {
        session()->forget('lang');
      }

      session()->put('lang', $lang);
    } else {
      if (session()->has('lang')) {
        session()->forget('lang');
      }

      session()->put('lang', 'ar');
    }
    return back();
  }

  public function showLoginForm()
  {
    return view('admin.auth.login');
  }

  public function login(loginRequest $request)
  {
    if ($this->checkTooManyFailedAttempts()) {
      return $this->checkTooManyFailedAttempts();
    }

    $remember = 1 == $request->remember ? true : false;
    if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'is_blocked' => 0], $remember)) {

      RateLimiter::clear($this->throttleKey());

      session()->put('lang', 'ar');
      return Response::json(['status' => 'success', 'url' => route($this->getAdminFirstRouteName()), 'msg' => __('admin.login_successfully_logged')]);
    } else {
      if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
        auth('admin')->logout();
        return Response::json(['status' => 'fail', 'msg' => __('auth.blocked')]);
      }

      RateLimiter::hit($this->throttleKey(), $seconds = 3600);
      return response()->json(['status' => 'fail', 'msg' => __('admin.incorrect_password')]);
    }
  }

  /**
   * Get the rate limiting throttle key for the request.
   *
   * @return string
   */
  public function throttleKey()
  {
    return Str::lower(request('email')) . '|' . request()->ip();
  }

  /**
   * Ensure the login request is not rate limited.
   *
   * @return void
   */
  public function checkTooManyFailedAttempts()
  {
    if (! RateLimiter::tooManyAttempts($this->throttleKey(), 10)) {
      return;
    }
    return response()->json(['status' => 'status', 'msg' => 'IP address banned. Too many login attempts, try after 60 minute']);
  }

  public function logout()
  {
    $admin = Auth::guard('admin')->user();
    $admin->devices()->where('device_id', Session::get('admin_device_id'))->delete();
    Session::forget('admin_device_id');
    auth('admin')->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect(route('admin.login'));
  }
}
