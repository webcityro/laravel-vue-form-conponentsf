<script>
import Disabler from "../mixins/Disabler";
import Processor from "../mixins/Processor";

export default {
	mixins: [Disabler, Processor],

	props: {
		group: { type: String, required: true },
		name: { type: String, required: false, default: 'items' },
		alwaysEnabled: { type: Boolean, required: false, default: false }
	},

	created() {
		scEvent.on('disableStarted-'+this.group, this.disable);
		scEvent.on('disableEnded-'+this.group, this.enable);
	},

	render() {
		return this.$scopedSlots.default({
			isDisabled: this.isDisabled,
			processing: this.processing,
			trigger: this.conditionalTrigger
		});
	},

	methods: {
		conditionalTrigger() {
			if (this.isDisabled && !this.alwaysEnabled) {
				return;
			}

			this.trigger();
		},

		trigger() {
			console.log('Please implement trigger method!');
		}
	}
};
</script>
