<?php
namespace App\Http\Requests\Admin\Admin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}


	public function rules(): array
	{
		return [
			'name'      => 'required|max:191',
			'country_code' => 'required|exists:countries,country_code',
			'iso'          => 'required|exists:countries,iso2',
			'phone'        => 'required|numeric|unique:admins,phone,' . auth('admin')->id() . ',id,deleted_at,NULL|phone:' . $this->iso,
			'email'        => "required|email|max:191|unique:admins,email," . auth('admin')->id() . ',id,deleted_at,NULL',
			'avatar'     => 'nullable|image',
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
