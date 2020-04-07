<template>
	<div v-show="show" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
		<label
			v-if="label"
			:for="identity"
			:class="computedLabelCssClass"
			:style="computedLabelCssStyle"
		>{{ label }}</label>
		<select
			:class="computedInputCssClass"
			:style="computedInputCssStyle"
			:name="name"
			:id="identity"
			:disabled="isDisabled"
			v-focus="focus"
			v-model="selected"
			@change="update"
			multiple
		>
			<option v-if="placeholder" value>{{ placeholder }}</option>
			<option
				v-for="option in options"
				:key="option.value"
				:value="option.value"
			>{{ option.name }}</option>
		</select>
		<slot name="validation">
			<sc-validation
				:label="label"
				:id="identity"
				:name="name"
				:show="showValidation"
				:css-class="computedValidationCssClass"
				:validation="validation"
				:error="error"
			/>
		</slot>
	</div>
</template>

<script>
import MultiSelectInput from "../MultiSelectInput";

export default {
	mixins: [MultiSelectInput],

	props: {
		inputCssClass: { type: String, required: false, default: 'custom-select' }
	},

	mounted() {
		this.update();
		this.init();
		this.registerListeners();
	},

	methods: {
		update() {
			this.emit(this.selected);
		}
	}
};
</script>
