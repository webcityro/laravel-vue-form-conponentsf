<?php

namespace FC\Http\Requests;

use FC\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreTestFormRequest extends FormRequest {

	public function authorize()	{
		return true;
	}

	public function rules()	{
		return [
			'title' => ['required', 'in:1,2,3,4,5'],
			'firstName' => ['required', 'min:2', 'max:30'],
			'lastName' => ['required', 'min:2', 'max:30'],
			'email' => ['required', 'email'],
			'password' => ['required', new Password],
			'address' => 'array',
			'address.line_1' => 'required',
			'address.line_2' => 'present',
			'address.town' => 'required',
			'address.postalCode' => ['required', 'max:10'],
			'share' => ['required', 'in:a'],
			'privacy' => 'required',
			'terms' => 'accepted',
			'colors' => ['required', 'array', 'min:2', 'max:2'],
			'city' => ['required', 'in:1,2,3,6'],
			'fruit' => ['required', 'array'],
			'excerpt' => ['required', 'min:1', 'max:10'],
			'body' => 'required',
		];
	}
}
