<?php

namespace App\Http\Controllers\Api\User;

use App\Traits\ResponseTrait;
use App\Services\auth\AuthService;
use App\Http\Controllers\Controller;

use App\Http\Requests\Api\User\ForgetPassword\ForgetPasswordSendCodeRequest;
use App\Http\Requests\Api\User\ForgetPassword\ResetPasswordCheckCodeRequest;
use App\Http\Requests\Api\User\ForgetPassword\ForgetPasswordCheckCodeRequest;


class ForgetPasswordController extends Controller
{
    use ResponseTrait ;


    public function forgetPasswordSendCode(ForgetPasswordSendCodeRequest $request) {
        // Create a new instance of AuthService and call the forgetPasswordSendCode method
        $data = (new AuthService())->forgetPasswordSendCode($request->validated());

        // Check if the key is 'fail'
        if ($data['key'] == 'fail') {
            // Return the failure message
            return $this->failMsg($data['msg']);
        } else {
            // Return the success message
            return $this->successMsg($data['msg']);
        }
    }

    public function forgetPasswordCheckCode(ForgetPasswordCheckCodeRequest $request)
    {
        // Return the success message
        return $this->successMsg(__('auth.code_checked'));
    }

    public function resetPassword(ResetPasswordCheckCodeRequest $request)
    {
        // Instantiate the AuthService class and call the resetPassword method with the validated data from the request.
        $data = (new AuthService())->resetPassword($request->validated());

        // Return a success message JSON response.
        return $this->successMsg($data['msg']);
    }


    
}
