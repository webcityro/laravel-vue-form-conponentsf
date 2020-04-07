@extends('layouts.app')

@section('content')
<div class="container" id="form">
	<div class="row">
		<div class="col-12">
			<sc-form-wrapper
				group="dependable-dropdown-form"
				action="{{ route('dependable_dropdown.store') }}"
			>
				<div class="card" slot-scope="{ group, fields, validation, error, reset, clear, processing, isDisabled, enable, disable }">
					<div class="card-header">Dependable dropdown Form</div>

					<div class="card-body">
						<div class="container">
							<fieldset>
								<legend>Simple filtering</legend>
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Size"
											name="size"
											v-model="fields.size"
											placeholder="Please select one..."
											:options="[
												{
													name: 'Small',
													value: 1
												},
												{
													name: 'Medium',
													value: 2
												},
												{
													name: 'Large',
													value: 3
												}
											]"
											:validation="{
												'required': 'Please select your size.',
												'in:1,2,3': 'Invalid selection'
											}"
											:error="error"
											:focus="true"
										></sc-select-input>
									</div>

									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Color"
											name="color"
											v-model="fields.color"
											placeholder="Please select one..."
											:options="{
												1: [
													{
														name: 'Green',
														value: 1
													},
													{
														name: 'Orange',
														value: 2
													},
													{
														name: 'Yallow',
														value: 3
													}
												],
												2: [
													{
														name: 'Blue',
														value: 4
													},
													{
														name: 'White',
														value: 5
													},
													{
														name: 'Black',
														value: 6
													}
												],
												3: [
													{
														name: 'Silver',
														value: 7
													},
													{
														name: 'Brown',
														value: 8
													},
													{
														name: 'Pink',
														value: 9
													}
												]
											}"
											:validation="{
												'required': 'Please select your color.',
												'in:1,2,3,4,5,6,7,8,9': 'Invalid selection'
											}"
											:depends-on="fields.size"
											:disabled="true"
											:error="error"
										></sc-select-input>
									</div>
								</div>

								<div class="row">
									<div class="col-12">
										<sc-select-input
											:group="group"
											label="Brand"
											name="brant"
											v-model="fields.brant"
											placeholder="Please select one..."
											:options="{
												1: [
													{
														name: 'Apple',
														value: 1
													},
													{
														name: 'Banana',
														value: 2
													}
												],
												2: [
													{
														name: 'Orange',
														value: 4
													},
													{
														name: 'Peer',
														value: 5
													}
												],
												3: [
													{
														name: 'Plum',
														value: 7
													},
													{
														name: 'Cherry',
														value: 8
													}
												],
												4: [
													{
														name: 'Peech',
														value: 9
													},
													{
														name: 'Apricat',
														value: 10
													}
												],
												5: [
													{
														name: 'Plum',
														value: 11
													},
													{
														name: 'Cherry',
														value: 12
													}
												],
												6: [
													{
														name: 'Avocado',
														value: 13
													},
													{
														name: 'Banana',
														value: 2
													}
												],
												7: [
													{
														name: 'Orange',
														value: 4
													},
													{
														name: 'Cherry',
														value: 14
													}
												],
												8: [
													{
														name: 'Orange',
														value: 4
													},
													{
														name: 'Cherry',
														value: 14
													}
												],
												9: [
													{
														name: 'Plum',
														value: 11
													},
													{
														name: 'Cherry',
														value: 12
													}
												]
											}"
											:validation="{
												'required': 'Please select the brand.'
											}"
											:depends-on="fields.color"
											:disabled="true"
											:error="error"
										></sc-select-input>
									</div>
								</div>
							</fieldset>
							@include('layouts.partials.form-buttons-attached')
						</div>
					</div>
				</div>
			</sc-form-wrapper>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<sc-form-wrapper
				group="dependable-dropdown-ajax-form"
				action="{{ route('dependable_dropdown.store') }}"
			>
				<div class="card"
					slot-scope="{ group, fields, validation, error, reset, clear, processing, isDisabled, enable, disable }">
					<div class="card-header">Dependable dropdown with ajax Form</div>

					<div class="card-body">
						<div class="container">
							<fieldset>
								<legend>Ajax filtering</legend>
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Size"
											name="size"
											v-model="fields.size"
											placeholder="Please select one..."
											:options="{{ $sizes }}"
											:validation="{
												'required': 'Please select your size.'
											}"
											:error="error"
											:focus="true"
										></sc-select-input>
									</div>
									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Color"
											name="color"
											v-model="fields.color"
											placeholder="Please select one..."
											options="{{ route('dependable_dropdown.attributes') }}"
											:depends-on="fields.size"
											:fields="{
												size: fields.size,
												color: fields.color,
												brand: fields.brand
											}"
											:validation="{
												'required': 'Please select your color.'
											}"
											:error="error"
											:disabled="true"
										></sc-select-input>
									</div>
									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Brand"
											name="brand"
											v-model="fields.brand"
											placeholder="Please select one..."
											options="{{ route('dependable_dropdown.attributes') }}"
											:depends-on="fields.color"
											:fields="{
												size: fields.size,
												color: fields.color,
												brand: fields.brand
											}"
											:validation="{
												'required': 'Please select your brand.'
											}"
											:error="error"
											:disabled="true"
										></sc-select-input>
									</div>
								</div>
							</fieldset>
							@include('layouts.partials.form-buttons-attached')
						</div>
					</div>
				</div>
			</sc-form-wrapper>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<sc-form-wrapper
				group="dependable-dropdown-last-ajax-form"
				action="{{ route('dependable_dropdown.store') }}"
				:summary="{ total: 0 }"
			>
				<div class="card"
					slot-scope="{ group, fields, validation, error, reset, clear, processing, isDisabled, enable, disable, summary }">
					<div class="card-header">Dependable dropdown with ajax summary Form</div>

					<div class="card-body">
						<div class="container">
							<fieldset>
								<legend>Ajax summary</legend>
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Size"
											name="size"
											v-model="fields.size"
											placeholder="Please select one..."
											:options="{{ $sizes }}"
											:validation="{
												'required': 'Please select your size.'
											}"
											:error="error"
											:focus="true"
										></sc-select-input>
									</div>
									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Color"
											name="color"
											v-model="fields.color"
											placeholder="Please select one..."
											options="{{ route('dependable_dropdown.attributes') }}"
											:depends-on="fields.size"
											:fields="{
												size: fields.size,
												color: fields.color,
												brand: fields.brand
											}"
											:validation="{
												'required': 'Please select your color.'
											}"
											:error="error"
											:disabled="true"
										></sc-select-input>
									</div>
									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Brand"
											name="brand"
											v-model="fields.brand"
											placeholder="Please select one..."
											options="{{ route('dependable_dropdown.attributes') }}"
											:depends-on="fields.color"
											:fields="{
												size: fields.size,
												color: fields.color,
												brand: fields.brand
											}"
											:validation="{
												'required': 'Please select your brand.'
											}"
											:error="error"
											:disabled="true"
											:is-last="true"
										></sc-select-input>
									</div>
								</div>
							</fieldset>

							<fieldset>
								<legend>Summary</legend>
								<div class="row">
									<div class="col-12">
										<p v-if=summary.total>
											<strong>Price:</strong>
											<span v-text="summary.total"></span>
										</p>
										<p v-else>Please select all attributes to reval the price.</p>
									</div>
								</div>
							</fieldset>
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
