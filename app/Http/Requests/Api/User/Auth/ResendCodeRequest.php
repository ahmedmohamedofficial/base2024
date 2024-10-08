<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Models\User;
use App\Http\Requests\BaseRequest;

class ResendCodeRequest extends BaseRequest {

  public function rules() {
    return [
        'country_code' => 'required|numeric|digits_between:1,5',
        'phone'        => 'required|numeric|digits_between:9,10|exists:users,phone,deleted_at,NULL',
    ];
  }

  public function prepareForValidation(){
    $this->merge([
      'phone' => fixPhone($this->phone),
      'country_code' => fixPhone($this->country_code),
    ]);
  }

  public function withValidator($validator)
  {
    $validator->after(function ($validator) {
      $user = User::where(['phone' => $this->phone ,'country_code' => $this->country_code])->first() ;
      if (!$user) {
        $validator->errors()->add('not_user', trans('auth.failed'));
      }
    });
  }

}
