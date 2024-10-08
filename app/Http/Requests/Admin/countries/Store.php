<?php

namespace App\Http\Requests\Admin\countries;

use App\Http\Requests\BaseRequest;

class Store extends BaseRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name.ar'      => 'required|max:191',
			'name.en'      => 'required|max:191',
			'country_code' => 'required|unique:countries,country_code,NULL,id,deleted_at,NULL',
			'image'        => 'required|mimes:' . $this->mimesImage(),
			'iso2'         => 'required|string|exists:iso_codes,iso2|min:2|max:2|unique:countries,iso2,NULL,id,deleted_at,NULL',
		];

	}

	public function prepareForValidation()
	{
		$this->merge([
			'iso2'         => strtoupper($this->iso2),
			'country_code' => ltrim($this->country_code, '+'),
		]);
	}
}
