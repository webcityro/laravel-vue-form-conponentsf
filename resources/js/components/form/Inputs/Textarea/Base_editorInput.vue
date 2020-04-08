<template>
	<div v-show="show" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
		<label
			v-if="label"
			:for="identity"
			:class="computedLabelCssClass"
			:style="computedLabelCssStyle"
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
import Toolbar from "./Toolbar";
import Colors from "./Colors";
import BaseInput from "../BaseInput";

export default {
	mixins: [BaseInput],

	props: {
		config: { type: Object, required: false, default: () => { return {}; } }
	},

	data() {
		return {
			initialBody: this.$slots.body ? this.$slots.body[0].children[0].text : '',

			body: ''
		};
	},

	mounted() {
		this.init();
		this.registerListeners();
	},

	methods: {
		update() {
			this.emit(this.body);
		},

		reset() {
			this.setData(this.initialBody);
			this.emit(this.initialBody);
		},

		clear() {
			this.setData('');
			this.emit('');
		}
	}
};
</script>
