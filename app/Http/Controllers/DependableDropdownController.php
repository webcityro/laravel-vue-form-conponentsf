<?php

namespace FC\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use FC\Http\Requests\AttributesRequest;
use FC\Http\Requests\StoreDropdownRequest;

class DependableDropdownController extends Controller {

	public function index() {
		return view('form.dependableDropdown')
            ->with('sizes', AttributesRequest::sizes());
	}

	public function attributes(AttributesRequest $request) {
		return [
            'records' => $request->data(),
            'summary' => [
                'total' => $request->nonEmpty()->count() === 3 ? number_format($request->items['brand'], 2) : 0
            ]
        ];
	}

	public function create() {
		//
	}

	public function store(StoreDropdownRequest $request) {
		if (!app()->runningUnitTests()) {
            sleep(3);
        }

        return new JsonResponse([
            'behaviour' => 'confirmWithDialogAndReset',
            'message' => 'Your request has been processed successfully.'
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
