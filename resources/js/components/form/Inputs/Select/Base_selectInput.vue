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
		>
			<option v-if="placeholder" value>{{ placeholder }}</option>
			<option
				v-for="option in records"
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
import Helper from "../../../../core/Helper";
import BaseInput from "../BaseInput";
import AjaxCaller from "../../../mixins/AjaxCaller";

export default {
	mixins: [BaseInput, AjaxCaller],

	props: {
		inputCssClass: { type: String, required: false, default: 'custom-select' },
		dependsOn: { type: [String, Number], required: false },
		fields: { type: Object, required: false, default: () => { return {}; } },
		isLast: { type: Boolean, required: false, default: false }
	},

	data() {
		return {
			selected: this.initialValue,
			records: []
		};
	},

	mounted() {
		this.fetch();
		this.update();
		this.init();
		this.registerListeners();
	},

	methods: {
		fetch() {
			if (Helper.isObject(this.options)) {
				this.records = this.options[this.dependsOn];
				return;
			}

			if (typeof this.options === 'string') {
				this.fetchAjax();
				return;
			}
			this.records = this.options;
		},

		fetchAjax() {
			if (this.isDisabled) {
				return;
			}

			this.makeAjaxCall(this.callSuccessful, this.callFailed);
		},

		callSuccessful(response) {
			this.stopProcessingAjaxCall();
			this.records = response.data.records;

			if (response.data.summary) {
				scEvent.emit('updateSummary-'+this.group, response.data.summary);
			}
		},

		callFailed(error) {
			ErrorHandler.showError(error, this.stopProcessingAjaxCall);
		},

		update() {
			this.emit(this.selected);

			if (this.isLast) {
				this.fetch();
			}
		},

		reset() {
			if (this.initialValue) {
				this.emit(this.selected = this.initialValue);
				return;
			}

			this.clear();
		},

		clear() {
			this.emit(this.selected = '');
		}
	},

	computed: {
		endpoint() {
			return this.options;
		},

		requestData() {
			return {
				id: this.name,
				items: {
					...this.fields,
					[this.name]: this.selected
				}
			};
		}
	},

	watch: {
		dependsOn(value) {
			this.selected = '';

			if (!value) {
				this.disable();
			} else {
				this.enable();
				this.fetch();
			}

			this.emit(this.selected);
		}
	}
};
</script>
