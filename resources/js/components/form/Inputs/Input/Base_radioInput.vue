<template>
	<div v-show="show" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
		<label
			v-if="label"
			:for="identity"
			:class="computedLabelCssClass"
			:style="computedLabelCssStyle"
		>{{ label }}</label>
		<div
			v-for="option in options"
			:key="option.value"
			:class="computedOptionWrapperCssClass"
			:style="computedOptionWrapperCssStyle"
		>
			<input
				type="radio"
				:class="computedOptionInputCssClass"
				:style="computedOptionInputCssStyle"
				:name="name"
				:id="option_id = optionID(option)"
				:autocomplete="autocomplete"
				:disabled="isDisabled"
				:value="option.value"
				v-model="checked"
				@change="update"
			>
			<label
				:for="option_id"
				:class="computedOptionLabelCssClass"
				:style="computedOptionLabelCssStyle"
			>{{ option.name }}</label>
		</div>
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
import BaseInput from "../BaseInput"
import BaseCheckboxInput from "./Checkbox/BaseCheckboxInput";;

export default {
	mixins: [BaseCheckboxInput, BaseInput],

	props: {
		optionWrapperCssClass: { type: String, required: false, default: 'custom-control custom-radio' }
	},

	data() {
		return {
			checked: this.initialValue
		};
	},

	mounted() {
		if (this.checked) {
			this.emit(this.checked);
		}

		this.init();
		this.registerListeners();
	},

	methods: {
		update(event) {
			this.emit(this.checked = event.target.value);
		},

		reset() {
			if (this.initialValue) {
				this.emit(this.checked = this.initialValue);
				return;
			}

			this.clear();
		},

		clear() {
			this.checked = false;
			scEvent.emit('removeField-'+this.group, this.name);
		}
	}
};
</script>
