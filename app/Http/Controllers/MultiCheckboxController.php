<?php

namespace FC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MultiCheckboxController extends Controller {

	public function index()	{
		return view('form.multiCheckbox');
	}

	public function create() {
		//
	}

	public function store(Request $request)	{
		//
	}

	public function show($id) {
		//
	}

	public function edit($id) {
		//
	}

	public function update(Request $request, $id) {
		//
	}

	public function destroy(Request $request, $id) {
		$message = 'The following records have been removed successfully: "';
        $message .= implode(', ', $request->input('items'));
        $message .= '"';

        session()->flash('sessionDialog', json_encode([
			'type' => 'topAlert',
			'style' => 'success',
            'message' => $message,
        ]));

        return new JsonResponse;
	}

	public function export(Request $request) {
		return $request->records;
	}
}
