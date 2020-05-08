@extends('layouts.app')

@section('content')
<div class="container" id="form">
	<sc-multi-checkbox-trigger
		group="multi-checkbox-form"
		:disabled="true"
		behaviour="reload"
		listen="select-single"
		action="{{ route('multi_checkbox.destroy', ['multi_checkbox' => 1]) }}"
		method="delete"
	>
		<button
			type="button"
			:class="['btn', 'btn-danger', {'is-disabled': isDisabled}]"
			slot-scope="{ isDisabled, processing, trigger }"
			:disabled="isDisabled"
			@click="trigger"
		>
			<span v-if="!processing"><i class="fas fa-trash fa-fw"></i> Delete</span>
			<span v-else><i class="fas fa-spinner fa-spin fa-fw"></i> Deleting...</span>
		</button>
	</sc-multi-checkbox-trigger>

	<sc-multi-checkbox-trigger
		group="multi-checkbox-form"
		name="records"
		:disabled="true"
		behaviour="goTo"
		listen="select-single"
		action="{{ route('multi_checkbox.export') }}"
	>
		<button
			type="button"
			:class="['btn', 'btn-success', {'is-disabled': isDisabled}]"
			slot-scope="{ isDisabled, processing, trigger }"
			:disabled="isDisabled"
			@click="trigger"
		>
			<span v-if="!processing"><i class="fas fa-download fa-fw"></i> Download</span>
			<span v-else><i class="fas fa-spinner fa-spin fa-fw"></i> Downloading...</span>
		</button>
	</sc-multi-checkbox-trigger>
	<div class="row">
		<div class="col-12">
			<sc-form-wrapper
				group="multi-checkbox-form"
				action="{{ route('multi_checkbox.store') }}"
				behaviour="confirmWithDialogAndClear"
			>
				<div class="card" slot-scope="{ group, fields, validation, error, reset, clear, processing, isDisabled, enable, disable, enableEvent, disableEvent }">
					<div class="card-header">Multi checkbox Form</div>

					<div class="card-body">
						<div class="container">
							<div class="row mb-3">
								<div class="col-12">
									<sc-master-checkbox-input
										:group="group"
										label="Select all"
										name="selectAll"
										:total="3"
										listen="select-single"
										fire="select-multiple"
										:disabled="isDisabled"
									></sc-master-checkbox-input>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<sc-checkbox-input
										:group="group"
										label="Go to store"
										name="goToStore"
										v-model="fields.goToStore"
										listen="select-multiple"
										fire="select-single"
										true-value="goToStore"
										:disabled="isDisabled"
									></sc-checkbox-input>
								</div>
							</div>

							<div class="row">
								<div class="col-12">
									<sc-checkbox-input
										:group="group"
										label="Take out the trash"
										name="takeOutTrash"
										v-model="fields.takeOutTrash"
										listen="select-multiple"
										fire="select-single"
										true-value="takeOutTrash"
									></sc-checkbox-input>
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-12">
									<sc-checkbox-input
										:group="group"
										label="Take over the world"
										name="takeOverTheWorld"
										v-model="fields.takeOverTheWorld"
										listen="select-multiple"
										fire="select-single"
										true-value="takeOverTheWorld"
										:disabled="isDisabled"
									></sc-checkbox-input>
								</div>
							</div>
							@include('layouts.partials.form-buttons-attached')
						</div>
					</div>
				</div>
			</sc-form-wrapper>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/form/index.js') }}"></script>
@endsection
