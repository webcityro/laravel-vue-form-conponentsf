<script>
import Helper from "../../../core/Helper";
import Error from "../Validator/Error";
import Disabler from "../../mixins/Disabler";

export default {
	mixins: [Disabler],

	props: {
		group: { type: String, required: false },
		label: { type: String, required: false },
		name: { type: String, required: true },
		id: { type: String, required: false },
		value: { required: false, default: '' },
		initialValue: { required: false, default: '' },
		options: { type: [Array, Object, String], required: false, default: () => [] },
		placeholder: { type: String, required: false },
		focus: { type: Boolean, default: false },
		maxlength: { type: String, required: false },
		autocomplete: { type: String, required: false },
		validation: { type: [Array, Object], required: false, default: () => { return {}; } },
		error: { type: Object, default: () => new Error() },
		visible: { type: Boolean, default: true },
		wrapperCssClass: { type: String, required: false, default: 'form-group' },
		inputCssClass: { type: String, required: false, default: 'form-control' },
		inputCssStyle: { type: String, required: false },
		inputErrorCssStyle: { type: String, required: false },
		inputErrorCssClass: { type: String, required: false, default: 'is-invalid' },
		validationCssClass: { type: String, required: false, default: 'invalid-feedback' },
		wrapperErrorCssClass: { type: String, required: false },
		wrapperCssStyle: { type: String, required: false },
		wrapperErrorCssStyle: { type: String, required: false },
		labelCssClass: { type: String, required: false, default: '' },
		labelErrorCssClass: { type: String, required: false, default: '' },
		labelCssStyle: { type: String, required: false, default: '' },
		labelErrorCssStyle: { type: String, required: false, default: '' },
		listen: { type: String, required: false },
		fire: { type: String, required: false },
	},

	data() {
		return {
			identity: this.id ? this.id : this.name,
			show: this.visible,
			displayValivation: false
		}
	},

	methods: {
		emit(value, event = 'input') {
			this.emitFireEvent(value);
			this.$emit(event, value);
		},

		emitFireEvent(value) {
			if (this.fire) {
				scEvent.emit(this.fire, value);
			}
		},

		init() {
			if (Helper.isEmpty(this.validation)) {
				return;
			}

			let rules = this.validation;

			if (!Array.isArray(this.validation)) {
				this.displayValivation = true;
				rules = Object.keys(this.validation);
			}

			scEvent.emit('initialize-'+this.group, {
				field: this.name,
				rules
			});
		},

		registerListeners() {
			scEvent.on('resetForm-'+this.group, this.reset);
			scEvent.on('clearForm-'+this.group, this.clear);
		},

		reset() {
			console.log('Please provide reset method implentatin for '+this.name);
		},

		clear() {
			console.log('Please provide clear method implentatin for '+this.name);
		},

		optionID(option) {
			return option.id || this.name+'-'+option.value;
		}
	},

	computed: {
		isInvalid() {
			return this.error.has(this.name);
		},

		showValidation() {
			return this.displayValivation && this.isInvalid;
		},

		computedInputCssClass() {
			return [
				{
					[this.inputErrorCssClass]: this.isInvalid
				},
				this.inputCssClass
			];
		},

		computedInputCssStyle() {
			return [
				{
					[this.inputErrorCssStyle]: this.isInvalid
				},
				this.inputCssStyle
			];
		},

		computedLabelCssClass() {
			return [
				{
					[this.labelErrorCssClass]: this.isInvalid
				},
				this.labelCssClass
			];
		},

		computedLabelCssStyle() {
			return [
				{
					[this.labelErrorCssStyle]: this.isInvalid
				},
				this.labelCssStyle
			];
		},

		computedValidationCssClass() {
			return {
				[this.validationCssClass]: this.isInvalid
			};
		},

		computedWrapperCssClass() {
			return [
				(this.wrapperErrorCssClass ? {
					[this.wrapperErrorCssClass]: this.isInvalid
				} : {}),
				this.wrapperCssClass
			];
		},

		computedWrapperCssStyle() {
			return [
				{
					[this.wrapperErrorCssStyle]: this.isInvalid
				},
				this.wrapperCssStyle
			];
		}
	},

	watch: {
		disabled(isDisabled) {
			if (isDisabled) {
				this.disable();
			} else {
				this.enable();
			}
		}
	}
};
</script>
