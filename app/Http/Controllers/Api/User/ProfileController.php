<?php

namespace App\Http\Controllers\Api\User;

use App\Models\UserUpdate;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\UserResource;


use App\Http\Requests\Api\User\Profile\UpdateProfileRequest;
use App\Http\Requests\Api\User\Profile\UpdatePasswordRequest;
use App\Http\Requests\Api\User\Profile\ChangePhoneSendCodeRequest;
use App\Http\Requests\Api\User\Profile\ChangePhoneCheckCodeRequest;


class ProfileController extends Controller
{
    use ResponseTrait ;

    public function getProfile(Request $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Create a UserResource instance with the user data
        $userResource = UserResource::make($user);

        // Set the token in the UserResource instance
        $userResource->setToken(ltrim($request->header('authorization'), 'Bearer '));

        // Return the success data with the UserResource instance
        return $this->successData($userResource);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        // Update the user profile using the AuthService
        $data = (new AuthService())->updateProfile($request->validated());

        // Get the request token from the authorization header
        $requestToken = ltrim($request->header('authorization'), 'Bearer ');

        // Create a UserResource with the updated user data and set the request token
        $userResource = UserResource::make($data['user'])->setToken($requestToken);

        // Return the success response with the message and user resource
        return $this->response('success', $data['msg'], $userResource);
    }
    
    public function updatePassword(UpdatePasswordRequest $request)
    {
        // Update the user's password in the database
        auth()->user()->update($request->validated());

        // Return the success message
        return $this->successMsg(__('apis.updated'));
    }

    function checkPassword(Request $request)
    {
        // Check if the provided password matches the user's password
        if (!Hash::check($request->password, auth()->user()->password)) {
            // If the password is incorrect, return an error message
            return $this->failMsg(trans('auth.incorrect_pass'));
        }

        // If the password is correct, return a success message
        return $this->successMsg(__('auth.correct_password'));
    }

    public function changePhoneSendCode(ChangePhoneSendCodeRequest $request)
    {
        // Update or create a new user update record
        $update = UserUpdate::updateOrCreate([
            'user_id'      => auth()->id(),
            'type'         => 'phone',
        ], [
            'country_code' => $request->country_code,
            'phone'        => $request->phone,
            'code'         => '1'
        ])->refresh();

        // Send the code to the user's phone number
        auth()->user()->sendCodeAtSms($update->code, $update->full_phone);

        // Return a success message
        return $this->successMsg(__('apis.success'));
    }

    public function changePhoneReSendCode(ChangePhoneSendCodeRequest $request)
    {
        // Update or create a new user update record
        $update = UserUpdate::updateOrCreate([
            'user_id'      => auth()->id(),
            'type'         => 'phone',
            'country_code' => $request->country_code,
            'phone'        => $request->phone,
        ], [
            'code'         => '1'
        ])->refresh();

        // Send the code to the user's phone number
        auth()->user()->sendCodeAtSms($update->code, $update->full_phone);

        // Return a success message
        return $this->successMsg(__('apis.success'));
    }

    public function changePhoneCheckCode(ChangePhoneCheckCodeRequest $request)
    {
        // Find the user update record with the provided code
        $update = UserUpdate::where([
            'user_id' => auth()->id(),
            'type' => 'phone',
            'code' => $request->code
        ])->first();

        // If no user update record is found, return an error message
        if (!$update) {
            return $this->failMsg(trans('auth.code_invalid'));
        }

        // Update the user's phone and country code with the values from the user update record
        auth()->user()->update([
            'phone' => $update->phone,
            'country_code' => $update->country_code
        ]);

        // Delete the user update record
        $update->delete();

        // Return a success message
        return $this->successMsg(__('auth.phone_updated'));
    }


    
    
}
