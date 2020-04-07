<template>
	<div
		v-show="show"
		:class="computedWrapperCssClass"
		:style="computedWrapperCssStyle"
	>
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
				type="checkbox"
				:class="computedOptionInputCssClass"
				:style="computedOptionInputCssStyle"
				:name="name"
				:id="option_id = optionID(option)"
				:autocomplete="autocomplete"
				:disabled="isDisabled"
				:checked="isSelected(option.value)"
				:value="option.value"
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
import MultiSelectInput from "../../MultiSelectInput";
import BaseCheckboxInput from "./BaseCheckboxInput";

export default {
	mixins: [MultiSelectInput, BaseCheckboxInput],

	mounted() {
		if (this.selected) {
			this.emit(this.selected);
		}

		this.init();
		this.registerListeners();
	},

	methods: {
		update(event) {
			const value = event.target.value;

			if (this.isSelected(value)) {
				this.selected = this.selected.filter(element => element !== value);
			} else {
				this.selected.push(value);
			}

			this.emit(this.selected);
		}
	}
};
</script>
