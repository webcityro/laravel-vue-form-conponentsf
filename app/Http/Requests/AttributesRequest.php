<?php

namespace FC\Http\Requests;

use Illuminate\Support\Collection;
use Illuminate\Foundation\Http\FormRequest;

class AttributesRequest extends FormRequest {

	public function authorize()	{
		return true;
	}

	public function rules(): array {
		return [
			'id' => 'required',
			'items' => 'required|array'
		];
	}

	public function nonEmpty(): Collection {
		return collect($this->items)->filter('isNotEmpty');
	}

	public static function sizes(): Collection {
		return new Collection([
			[
				'name' => 10,
				'value' => 1,
			],
			[
				'name' => 12,
				'value' => 2,
			]
		]);
	}

	public function data(): array {
		switch($this->id) {
			case 'color':
				return $this->color();
			case 'brand':
				return $this->brand();
			default:
				return [];
		}
	}

	private function color(): array {
		switch($this->items['size']) {
			case 1:
				return [
					[
						'name' => 'Green',
						'value' => 3
					],
					[
						'name' => 'Orange',
						'value' => 4
					]
				];
			case 2:
				return [
					[
						'name' => 'Brown',
						'value' => 5
					],
					[
						'name' => 'Pink',
						'value' => 6
					]
				];
			default:
				return [];
		}
	}

	private function brand(): array	{
		switch($this->items['color']) {
			case 3:
				return [
					[
						'name' => 'Apple',
						'value' => 7
					],
					[
						'name' => 'Orange',
						'value' => 8
					]
				];
			case 4:
				return [
					[
						'name' => 'Banana',
						'value' => 9
					],
					[
						'name' => 'Peach',
						'value' => 10
					]
				];
			case 5:
				return [
					[
						'name' => 'Plum',
						'value' => 11
					],
					[
						'name' => 'Avocado',
						'value' => 12
					]
				];
			case 6:
				return [
					[
						'name' => 'Strawberry',
						'value' => 13
					],
					[
						'name' => 'Blueberry',
						'value' => 14
					]
				];
			default:
				return [];
		}
	}
}
