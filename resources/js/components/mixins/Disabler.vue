<script>
export default {
	props: {
		disabled: { type: Boolean, required: false, default: false }
	},

	data() {
		return {
			isDisabled: this.disabled
		};
	},

	methods: {
		disable() {
			this.isDisabled = true;
		},

		enable() {
			this.isDisabled = false;
		}
	}
};
</script>
