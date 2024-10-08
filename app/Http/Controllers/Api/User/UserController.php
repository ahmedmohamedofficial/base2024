<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class UserController extends Controller {
  use ResponseTrait;

  public function changeLang(Request $request) {
      // Update the user's language preference
      auth()->user()->update(['lang' => $request->lang]);

      // Set the application locale to the new language
      App::setLocale($request->lang);

      // Return a success message
      return $this->successMsg(__('apis.updated'));
  }

}
