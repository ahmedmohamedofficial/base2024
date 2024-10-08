<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
	use ResponseTrait;

	protected function failedValidation ( Validator $validator )
	{
		if ( request()->is( 'api/*' ) ) {
			throw new HttpResponseException( $this->response( 'fail', $validator->errors()->first() ) );
		} else {
			throw ( new ValidationException( $validator ) )
				->errorBag( $this->errorBag )
				->redirectTo( $this->getRedirectUrl() );
		}
	}
	protected function mimesImage() : string
	{
		$extension = [
			'gif',
			'jpeg',
			'png',
			'swf',
			'psd',
			'bmp',
			'tiff',
			'tiff',
			'jpc',
			'jp2',
			'jpf',
			'jb2',
			'swc',
			'aiff',
			'wbmp',
			'xbm',
			'webp'
		];

		return implode( ',', $extension );
	}
	protected function languages () : string
	{
		return implode( ',', languages() );
	}
}
