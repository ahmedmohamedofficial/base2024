<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{

	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'name'         => 'required|max:191',
			'country_code' => 'required|exists:countries,country_code',
			'iso'          => 'required|exists:countries,iso2',
			'phone'        => 'required|numeric|unique:admins,phone,' . $this->id . ',id,deleted_at,NULL|phone:' . $this->iso,
			'email'        => "required|email|max:191|unique:admins,email," . $this->id . ',id,deleted_at,NULL',
			'password'     => 'nullable|min:6|max:255',
			'avatar'       => 'nullable|image',
			'role_id'      => 'required|exists:roles,id',
			'active'       => 'nullable|in:1,0',
			'is_blocked'   => 'required|in:1,0',
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
