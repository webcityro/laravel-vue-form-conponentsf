<script>
import Trigger from "./Trigger";
import AjaxCaller from "../mixins/AjaxCaller";
import MultiHandler from "../mixins/MultiHandler";
import Behaviour from "./Behaviour";

export default {
	mixins: [Trigger, AjaxCaller, MultiHandler],

	props: {
		behaviour: { type: String, required: false },
		listen: { type: String, required: false },
	},

	methods: {
		evaluate() {
			this.isDisabled = this.items.length === 0;
		},

		trigger() {
			if (Behaviour.isNonAjax(this.behaviour)) {
				Behaviour[this.behaviour](this, this.items);
				return;
			}

			this.makeAjaxCall(this.callSuccessful, this.callFailed);
		},

		startProcessingAjaxCallEvent() {
			scEvent.emit('disabledStarted-'+this.group);
		},

		stopProcessingAjaxCallEvent() {
			scEvent.emit('disabledEnded-'+this.group);
		},

		callSuccessful(response) {
			const behaviourMethod = this.behaviour || response.data.behaviour;

			try {
				Behaviour[behaviourMethod](this, response);
			} catch (error) {
				ErrorHandler.showError({
					message: 'Invalid form behaviour "'+behaviourMethod+'".'
				});
				this.stopProcessingAjaxCall();
			}
		},

		callFailed(error) {
			ErrorHandler.showError(error, this.stopProcessingAjaxCall);
		}
	},

	computed: {
		requestData() {
			return { items: this.items };
		}
	},
};
</script>
