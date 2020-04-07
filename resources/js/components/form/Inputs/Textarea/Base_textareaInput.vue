<template>
	<div v-show="show" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
		<label
			v-if="label"
			:for="identity"
			:class="computedLabelCssClass"
			:style="computedLabelCssStyle"
		>{{ label }}</label>
		<textarea
			:class="computedInputCssClass"
			:style="computedInputCssStyle"
			:name="name"
			:id="identity"
			:maxlength="maxlength"
			:placeholder="placeholder"
			:autocomplete="autocomplete"
			:disabled="isDisabled"
			v-model="body"
			v-focus="focus"
			v-on="listeners"
		></textarea>
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

	props: {
		heigth: { type: String, required: false, default: '7rem'}
	},

	data() {
		return {
			body: '',
			initialBody: this.$slots.body ? this.$slots.body[0].children[0].text : ''
		};
	},

	mounted() {
		this.reset();
		this.init();
		this.registerListeners();
	},

	methods: {
		reset() {
			this.emit(this.body = this.initialBody);
		},

		clear() {
			this.emit(this.body = '');
		}
	},

	computed: {
		listeners() {
			return {
				...this.$listeners,
				input: e => {
					this.emit(this.body);
				}
			}
		},

		computedInputCssStyle() {
			return {
				heigth: this.heigth
			};
		}
	}
};
</script>
