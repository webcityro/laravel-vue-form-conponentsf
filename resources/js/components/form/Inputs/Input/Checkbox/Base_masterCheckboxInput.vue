<template>
	<div
		v-show="show"
		:class="computedOptionWrapperCssClass"
		:style="computedOptionWrapperCssStyle"
	>
		<input
			type="checkbox"
			:class="computedInputCssClass"
			:style="computedInputCssStyle"
			:name="name"
			:id="identity"
			:autocomplete="autocomplete"
			:disabled="isDisabled"
			:checked="checked"
			:indeterminate.prop="indeterminate"
			v-model="checked"
			@change="update"
		>
		<label
			v-if="label"
			:for="identity"
			:class="computedOptionLabelCssClass"
			:style="computedOptionLabelCssStyle"
		>{{ label }}</label>
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
import BaseInput from "../../BaseInput";
import MultiHandler from "../../../../mixins/MultiHandler";
import BaseCheckboxInput from "./BaseCheckboxInput";

export default {
	mixins: [BaseInput, MultiHandler, BaseCheckboxInput],

	props: {
		total: { type: Number, required: true },
		fire: { type: String, required: true }
	},

	data() {
		return {
			checked: false,
			indeterminate: false
		};
	},

	created() {},

	mounted() {},

	methods: {
		evaluate() {
			const length = this.items.length;
			this.checked = this.total === length;
			this.indeterminate = length > 0 && length < this.total;
		},

		update() {
			scEvent.emit(this.fire, this.checked);
		}
	},

	computed: {},

	watch: {},
};
</script>
