<?php

namespace App\Http\Requests\Api\User\ForgetPassword;

use App\Models\User;
use App\Models\UserUpdate;
use App\Http\Requests\BaseRequest;

class ForgetPasswordCheckCodeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'code'         => 'required|max:10',
            'country_code' => 'required|numeric|digits_between:1,5',
            'phone'        => 'required|numeric|digits_between:9,10|exists:users,phone,deleted_at,NULL',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'phone' => fixPhone($this->phone),
            'country_code' => fixPhone($this->country_code),
        ]);
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = User::where([ 'phone' => $this->phone , 'country_code' => $this->country_code ])->first();
            if (!$user) {
                $validator->errors()->add('not_user', trans('auth.failed'));
            }
            $update = $user ? UserUpdate::where(['user_id' => $user->id , 'type' => 'password', 'code' => $this->code])->first() : null;
            if (!$update) {
                $validator->errors()->add('not_user', trans('auth.code_invalid'));
            }
        });
    }

}
