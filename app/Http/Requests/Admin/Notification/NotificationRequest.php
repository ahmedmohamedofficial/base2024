<?php

namespace App\Http\Requests\Admin\Notification;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'type'      => 'required',
			'user_type' => 'required',
			'body_ar'   => 'nullable|required_if:type,notify',
			'body_en'   => 'nullable|required_if:type,notify',
			'body'      => 'nullable|required_if:type,email,sms',
		];
	}

	public function messages()
	{
		return [
			'body_ar.required_if' => __('validation.required'),
			'body_en.required_if' => __('validation.required'),
			'body.required_if'    => __('validation.required'),
		];
	}
}
