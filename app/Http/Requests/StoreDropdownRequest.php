<?php

namespace FC\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDropdownRequest extends FormRequest {

	public function authorize()	{
		return true;
	}

	public function rules()	{
		return [
			'brand' => 'required',
			'size' => 'required',
			'color' => 'required'
		];
	}
}
