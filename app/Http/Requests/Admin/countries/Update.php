<?php

namespace App\Http\Requests\Admin\countries;

use App\Http\Requests\BaseRequest;

class Update extends BaseRequest
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
			'name.ar'      => 'required|max:191',
			'name.en'      => 'required|max:191',
			'country_code' => 'required|unique:countries,country_code,' . $this->id . ',id,deleted_at,NULL',
			'image'        => 'nullable|mimes:' . $this->mimesImage(),
			'iso2'         => 'required|string|exists:iso_codes,iso2|min:2|max:2|unique:countries,iso2,' . $this->id . ',id,deleted_at,NULL',


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
