<?php

namespace App\Http\Requests\Admin\settlements;

use App\Http\Requests\BaseRequest;

class Store extends BaseRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$image = ($this->status == 'rejected') ? 'nullable' : 'required';
		return [
			'id'              => 'required|exists:settlements,id',
			'image'           => $image . '|mimes:' . $this->mimesImage(),
			'status'          => 'required|in:accepted,rejected',
			'rejected_reason' => $this->status == 'rejected' ? 'required' : 'nullable',
		];
	}

	public function messages()
	{
		return [
			'amount.required' => __('site.amount_required'),
			'image.required'  => __('site.image_required'),
		];
	}


}