<script>
export default {
	props: {
		inputCssClass: { type: String, required: false, default: 'custom-control-input' },
		optionWrapperCssClass: { type: String, required: false, default: 'custom-control custom-checkbox'},
		optionWrapperErrorCssClass: { type: String, required: false, default: ''},
		optionWrapperCssStyle: { type: String, required: false, default: ''},
		optionWrapperErrorCssStyle: { type: String, required: false, default: ''},
		optionInputCssClass: { type: String, required: false, default: 'custom-control-input'},
		optionInputErrorCssClass: { type: String, required: false, default: ''},
		optionInputCssStyle: { type: String, required: false, default: ''},
		optionInputErrorCssStyle: { type: String, required: false, default: ''},
		optionLabelCssClass: { type: String, required: false, default: 'custom-control-label'},
		optionLabelErrorCssClass: { type: String, required: false, default: ''},
		optionLabelCssStyle: { type: String, required: false, default: ''},
		optionLabelErrorCssStyle: { type: String, required: false, default: ''},
	},

	computed: {
		computedOptionWrapperCssClass() {
			return [
				{
					[this.optionWrapperErrorCssClass]: this.isInvalid
				},
				this.optionWrapperCssClass
			];
		},

		computedOptionWrapperCssStyle() {
			return [
				{
					[this.optionWrapperErrorCssStyle]: this.isInvalid
				},
				this.optionWrapperCssStyle
			];
		},

		computedOptionInputCssClass() {
			return [
				{
					[this.optionInputErrorCssClass]: this.isInvalid
				},
				this.optionInputCssClass
			];
		},

		computedOptionInputCssStyle() {
			return [
				{
					[this.optionInputErrorCssStyle]: this.isInvalid
				},
				this.optionInputCssStyle
			];
		},

		computedOptionLabelCssClass() {
			return [
				{
					[this.optionLabelErrorCssClass]: this.isInvalid
				},
				this.optionLabelCssClass
			];
		},

		computedOptionLabelCssStyle() {
			return [
				{
					[this.optionLabelErrorCssStyle]: this.isInvalid
				},
				this.optionLabelCssStyle
			];
		}
	}
};
</script>
