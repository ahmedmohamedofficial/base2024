<?php

namespace App\Http\Requests\Admin\Client;

use App\Http\Requests\BaseRequest;


class Store extends BaseRequest
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
			'name'         => 'required|max:191',
			'is_blocked'   => 'required',
			'country_code' => 'required|numeric|digits_between:2,5',
			'iso'          => 'required|exists:countries,iso2',
			'phone'        => 'required|numeric|unique:users,phone,NULL,id,deleted_at,NULL|phone:' . $this->iso,
			'email'        => 'required|email:filter|max:191|unique:users,email,NULL,NULL,deleted_at,NULL',
			'password'     => ['required', 'min:6'],
			'avatar'       => 'nullable|mimes:' . $this->mimesImage(),
		];
	}

	public function prepareForValidation()
	{
		$this->merge([
			'phone'        => fixPhone($this->phone),
			'country_code' => fixPhone($this->country_code),
			'iso'          => strtoupper($this->iso)
		]);
	}
}
