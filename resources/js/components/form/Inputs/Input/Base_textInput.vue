<template>
	<div v-show="show" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
		<label
			v-if="label"
			:for="identity"
			:class="computedLabelCssClass"
			:style="computedLabelCssStyle"
		>{{ label }}</label>
		<input
			:type="type"
			:class="computedInputCssClass"
			:style="computedInputCssStyle"
			:name="name"
			:id="identity"
			:value="value"
			:maxlength="maxlength"
			:placeholder="placeholder"
			:autocomplete="autocomplete"
			:disabled="isDisabled"
			v-focus="focus"
			v-on="listeners"
		>
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
import BaseInput from "../BaseInput";

export default {
	mixins: [BaseInput],

	data() {
		return {
			type: 'text'
		};
	},

	mounted() {
		this.emit(this.initialValue);
		this.init();
		this.registerListeners();
	},

	methods: {
		reset() {
			this.emit(this.initialValue);
		},

		clear() {
			this.emit('');
		}
	},

	computed: {
		listeners() {
			return {
				...this.$listeners,
				input: e => {
					this.emit(e.target.value);
				}
			}
		}
	}
};
</script>

<style>
</style>
