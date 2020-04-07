@extends('layouts.app')

@section('content')
<div class="container" id="form">
	@include('layouts.partials.form-buttons-detached', ['group' => 'test-form'])
	<div class="row">
		<div class="col-12">
			<sc-form-wrapper
				group="test-form"
				action="{{ route('main.store') }}"
				behaviour="confirmWithDialogAndClear"
				:collections="{ address: {}, colors: [], fruit: [] }"
			>
				<div class="card" slot-scope="{ group, fields, validation, error, reset, clear, processing, isDisabled, enable, disable }">
					<div class="card-header">Main</div>

					<div class="card-body">
						<div class="container">
							<fieldset>
								<legend>Personal details</legend>
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<sc-select-input
											:group="group"
											label="Title"
											name="title"
											v-model="fields.title"
											initial-value="1"
											placeholder="Please select one..."
											:options="[
												{
													name: 'Mr',
													value: 1
												},
												{
													name: 'Mrs',
													value: 2
												},
												{
													name: 'Ms',
													value: 3
												},
												{
													name: 'Master',
													value: 4
												},
												{
													name: 'Miss',
													value: 5
												},
											]"
											:validation="{
												'required': 'Please select your title.',
												'in:1,2,3,4,5': 'Invalid selection'
											}"
											:error="error"
											:focus="true"
										></sc-select-input>
										</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<sc-text-input
											:group="group"
											label="First name"
											name="firstName"
											v-model="fields.firstName"
											initial-value="andy"
											placeholder="First Name"
											maxlength="10"
											autocomplete="given-name"
											:validation="{
												'required': 'The first name is required.',
												'min:2': 'Minimum length 2 chars.',
												'max:30': 'Maximum length 30 chars.'
											}"
											:error="error"
											:disabled="isDisabled"
										></sc-text-input>
									</div>
									<div class="col-sm-12 col-md-6">
										<sc-text-input
											:group="group"
											label="Last name"
											name="lastName"
											v-model="fields.lastName"
											initial-value="bn1"
											placeholder="last Name"
											maxlength="10"
											autocomplete="given-name"
											:validation="['required', 'min:2', 'max:30']"
											:error="error"
											:disabled="isDisabled"
										>
										<template slot="validation">
											<sc-validation
												label="Last name"
												name="lastName"
												:show="error.has('lastName')"
												:validation="{
													'required': 'The last name is required.',
													'min:2': 'Minimum length 2 chars.',
													'max:30': 'Maximum length 30 chars.'
												}"
												:error="error"
											></sc-validation>
										</template>
										</sc-text-input>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12 col-md-6">
										<sc-email-input
											:group="group"
											label="Email address"
											name="email"
											v-model="fields.email"
											placeholder="you@email.com"
											:validation="{
												'required': 'The email address is required.',
												'email': 'Invalid email address.'
											}"
											:error="error"
											:disabled="isDisabled"
										></sc-email-input>
									</div>
									<div class="col-sm-12 col-md-6">
										<sc-password-input
											:group="group"
											label="Password"
											name="password"
											v-model="fields.password"
											:validation="{
												'required': 'The password is required.',
												'password': 'Invalid password.'
											}"
											:error="error"
											:disabled="isDisabled"
										></sc-password-input>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12 col-md-6">
										<sc-text-input
											:group="group"
											label="Address line 1"
											name="address.line_1"
											v-model="fields.address.line_1"
											:validation="{
												'required': 'The address is required.',
											}"
											:error="error"
											:disabled="isDisabled"
										></sc-text-input>
									</div>
									<div class="col-sm-12 col-md-6">
										<sc-text-input
											:group="group"
											label="Address line 2"
											name="address.line_2"
											v-model="fields.address.line_2"
											:disabled="isDisabled"
										></sc-text-input>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12 col-md-6">
										<sc-text-input
											:group="group"
											label="Town"
											name="address.town"
											v-model="fields.address.town"
											:validation="{
												'required': 'The town is required.',
											}"
											:error="error"
											:disabled="isDisabled"
										></sc-text-input>
									</div>
									<div class="col-sm-12 col-md-6">
										<sc-text-input
											:group="group"
											label="Postal code"
											name="address.postalCode"
											v-model="fields.address.postalCode"
											:validation="{
												'required': 'The postal code is required.',
											}"
											:error="error"
											:disabled="isDisabled"
										></sc-text-input>
									</div>
								</div>

							</fieldset>

							<div class="row">
								<div class="col-sm-12 col-md-6">
									<fieldset>
										<legend>Consent</legend>
										<div class="row">
											<div class="col-12">
												<sc-checkbox-input
													:group="group"
													label="Please share my data with third pary"
													name="share"
													v-model="fields.share"
													:validation="{
														'required': 'Invalid selection',
														'in:a': 'we have to share your data.'
													}"
													:error="error"
													true-value="a"
													false-value="b"
													validation-css-class="block invalid-feedback"
												></sc-checkbox-input>
											</div>
											<div class="col-12">
												<sc-checkbox-input
													:group="group"
													label="I agree to the privacy policy"
													name="privacy"
													v-model="fields.privacy"
													:validation="{
														'required': 'You have to agree to the privacy policy'
													}"
													:error="error"
													:remove-when-false="true"
													validation-css-class="block invalid-feedback"
												></sc-checkbox-input>
											</div>
										</div>

										<div class="row">
											<div class="col-12">
												<sc-checkbox-input
													:group="group"
													label="I agree to the terms and conditions"
													name="terms"
													v-model="fields.terms"
													:validation="{
														'required': 'You have to agree to the terms and conditions'
													}"
													:error="error"
													validation-css-class="block invalid-feedback"
												></sc-checkbox-input>
											</div>
										</div>
									</fieldset>
								</div>

								<div class="col-sm-12 col-md-6">
									<fieldset>
										<legend>Colors (select exactly 2 colors)</legend>
										<sc-checkbox-group-input
										:group="group"
										label="Colors"
										name="colors"
										v-model="fields.colors"
										:options="[
											{
												name: 'Blue',
												value: 'blue'
											},
											{
												name: 'Green',
												value: 'green'
											},
											{
												name: 'Orange',
												value: 'orange'
											},
										]"
										:validation="{
											'required': 'The colors are required.',
											'length:2': 'You must select exactly 2 colors.'
										}"
										:error="error"
									></sc-checkbox-group-input>
									</fieldset>
								</div>
							</div>

								<div class="row">
									<div class="col-sm-12 col-md-6">
										<fieldset>
											<legend>Citys</legend>

											<sc-radio-input
												:group="group"
												name="city"
												label="City"
												v-model="fields.city"
												:validation="{
													'in:1,2,3,6': 'Please select your city.'
												}"
												:error="error"
												initial-value="3"
												:options="[
													{
														name: 'London',
														value: 1
													},
													{
														name: 'Paris',
														value: 2
													},
													{
														name: 'New york',
														value: 3
													},
													{
														name: 'Bucharest',
														value: 6
													}
												]"
											></sc-radio-input>
										</fieldset>
									</div>
									<div class="col-sm-12 col-md-6">
										<fieldset>
											<legend>Fruit</legend>
											<sc-select-multiple-input
												:group="group"
												name="fruit"
												label="Fruit"
												v-model="fields.fruit"
												:validation="{
													'required': 'Please select your fruit.'
												}"
												:error="error"
												:initial-value="['banana', 'apple']"
												:options="[
													{
														name: 'Apple',
														value: 'apple'
													},
													{
														name: 'Orange',
														value: 'orange'
													},
													{
														name: 'Grapefruit',
														value: 'grapefruit'
													},
													{
														name: 'Banana',
														value: 'banana'
													}
												]"
											></sc-select-multiple-input>
										</fieldset>
									</div>
								</div>

								<div class="row">
									<div class="col-12">
										<sc-textarea-input
											:group="group"
											name="excerpt"
											label="Excerpt"
											v-model="fields.excerpt"
											:validation="{
												'required': 'Please provide the excerpt'
											}"
											:error="error"
										>
											<div slot="body">Content goes here...</div>
										</sc-textarea-input>
									</div>
								</div>

								<div class="row">
									<div class="col-12">
										<sc-editor-input
											:group="group"
											name="body"
											label="Body"
											v-model="fields.body"
											:validation="{
												'required': 'Please provide the body'
											}"
											:error="error"
										>
											<div slot="body">Editor content goes here...</div>
										</sc-editor-input>
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
