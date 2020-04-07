<?php

namespace FC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use FC\Http\Requests\StoreTestFormRequest;

class MainController extends Controller {
	public function index() {
		return view('form.main');
	}

	public function create() {
		//
	}

	public function store(StoreTestFormRequest $request) {
		if (!app()->runningUnitTests()) {
			sleep(5);
		}

		return new JsonResponse([
			'behaviour' => 'confirmWithDialogAndReset',
			'message' => 'Your request has been processed successfully!'
		]);
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

	public function destroy($id) {
		//
	}
}
