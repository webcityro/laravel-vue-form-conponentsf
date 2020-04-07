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
import BaseCheckboxInput from "./BaseCheckboxInput";

export default {
	mixins: [BaseInput, BaseCheckboxInput],

	props: {
		removeWhenFalse: { type: Boolean, required: false, default: false},
		trueValue: { required: false, default: true},
		falseValue: { required: false, default: false}
	},

	data() {
		return {
			checked: this.isSelected()
		};
	},

	mounted() {
		this.update();
		this.init();
		this.registerListeners();
		this.registerCustomListeners();
	},

	methods: {
		registerCustomListeners() {
			if (this.listen) {
				scEvent.on(this.listen, checked => {
					this.checked = checked;
					this.emitFireEvent();
				});
			}
		},

		emitFireEvent() {
			BaseInput.methods.emitFireEvent.call(this, {
				value: this.trueValue,
				remove: !this.checked
			});

			this.$emit('input', this.valueToEmit);
		},

		isSelected() {
			return this.initialValue === this.trueValue;
		},

		update() {
			if (!this.checked && this.removeWhenFalse) {
				scEvent.emit('removeField-'+this.group, this.name);
				return;
			}

			this.emit(this.valueToEmit);
		},

		reset() {
			this.checked = this.isSelected();
			this.update();
		},

		clear() {
			this.checked = false;
			this.update();
		}
	},

	computed: {
		valueToEmit() {
			return this.checked ? this.trueValue : this.falseValue;
		}
	}
};
</script>
