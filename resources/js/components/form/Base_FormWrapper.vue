<template>
	<form novalidate @submit.prevent="submit">
		<slot
			:group="group"
			:fields="fields"
			:validation="validationBag"
			:processing="processing"
			:isDisabled="isDisabled"
			:error="error"
			:reset="reset"
			:clear="clear"
			:enable="enable"
			:disable="disable"
			:enableEvent="enableEvent"
			:disableEvent="disableEvent"
			:summary="summaryBag"
			:submit="submit"
		></slot>
	</form>
</template>

<script>
import Behaviour from "./Behaviour";
import Helper from '../../core/Helper';
import Error from "./Validator/Error";
import Validator from "./Validator/Validator";
import AjaxCaller from "../mixins/AjaxCaller";
import Disabler from "../mixins/Disabler";

export default {
	mixins: [AjaxCaller, Disabler],

	props: {
		group: { type: String, required: true },
		behaviour: { type: String, required: false },
		eventSubmitOnly: { type: Boolean, required: false, default: false },
		collections: { type: Object, required: false, default: () => { return {}; }},
		summary: { type: Object, required: false, default: () => { return {}; }}
	},

	data() {
		return {
			fields: {...this.collections},
			validationBag: {},
			error: new Error,
			summaryBag: this.summary
		}
	},

	created() {
		scEvent.on('initialize-'+this.group, this.init);
		scEvent.on('submit-'+this.group, this.submitEvent);
		scEvent.on('reset-'+this.group, this.reset);
		scEvent.on('clear-'+this.group, this.clear);
		scEvent.on('disableStarted-'+this.group, this.disable);
		scEvent.on('disableEnded-'+this.group, this.enable);
		scEvent.on('removeField-'+this.group, this.removeField);
		scEvent.on('updateSummary-'+this.group, this.updateSummary);
	},

	mounted() {
		if (this.isDisabled) {
			scEvent.emit('disableStarted-'+this.group);
		}
	},

	methods: {
		startProcessingAjaxCallEvent() {
			scEvent.emit([
				'submissionStarted-'+this.group,
				'disableStarted-'+this.group
			]);
		},

		stopProcessingAjaxCallEvent() {
			scEvent.emit([
				'submissionEnded-'+this.group,
				'disableEnded-'+this.group
			]);
		},

		init(data) {
			if (!this.validationBag.hasOwnProperty(data.field)) {
				this.validationBag[data.field] = data.rules;
			}
		},

		disable() {
			this.clearNotifications();
			Disabler.methods.disable.call(this);
		},

		enableEvent() {
			scEvent.emit('disableEnded-'+this.group);
		},

		disableEvent() {
			scEvent.emit('disableStarted-'+this.group);
		},

		reset() {
			if (this.isDisabled) {
				return;
			}

			this.cleanse('reset');
		},

		clear() {
			if (this.isDisabled) {
				return;
			}

			this.cleanse('clear');
		},

		cleanse(type) {
			this.summaryBag = this.summary;
			this.clearNotifications();
			scEvent.emit(type+'Form-'+this.group);
		},

		clearNotifications() {
			this.error.clear();
			scEvent.emit('clearTopDialog');
		},

		removeField(field) {
			Helper.removeObjectProperties(this, [field], this.fields);
		},

		updateSummary(data) {
			this.summaryBag = {
				...this.summaryBag,
				...data
			};
		},

		submit() {
			if (this.eventSubmitOnly) {
				return;
			}

			this.submitEvent();
		},

		submitEvent() {
			if (this.isDisabled) {
				return;
			}

			this.validate().then(this.makeCall).catch(this.callFailed);
		},

		validate() {
			return new Promise((resolve, reject) => {
				if (!this.requiresFvalidation()) {
					resolve();
					return;
				}

				this.error = new Error;
				new Validator(this, resolve,  reject);
			});
		},

		requiresFvalidation() {
			return !Helper.isEmpty(this.validationBag);
		},

		makeCall() {
			scEvent.emit('clearTopDialog');
			this.makeAjaxCall(this.callSuccessful, this.callFailed);
		},

		callSuccessful(response) {
			try {
				Behaviour[this.behaviour ? this.behaviour : response.data.behaviour](this, response);
			} catch (error) {
				console.log({ callSuccessfulError: error });

				ErrorHandler.showError({message: 'Invalid form behaviour.'});
				this.stopProcessingAjaxCall();
			}
		},

		callFailed(error) {
			ErrorHandler.showError(error, this.stopProcessingAjaxCall);
		}
	},

	computed: {
		requestData() {
			return this.fields;
		}
	}
}
</script>
