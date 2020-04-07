<template>
	<div v-if="isVisible">
		<div
			v-if="!isType('confirm')"
			:class="wrapperCssClass"
			role="alert"
			v-html="message"
		></div>
		<div
			v-else
			:class="wrapperCssClass"
			role="alert"
		>
			<p v-html="message"></p>
			<div>
				<button class="btn btn-primary" v-if="!processing" @click="makeCall">YES</button>
				<button class="btn btn-primary" v-if="processing" disabled>
					<i class="fas fa-spinner fa-spin fa-fw"></i>
				</button>
				<button class="btn btn-success" @click="clear">NO</button>
			</div>
		</div>
	</div>
</template>

<script>
import Helper from '../../core/Helper';
import AjaxCaller from "../mixins/AjaxCaller";

export default {
	mixins: [AjaxCaller],

	props: {
		sessionDialog: { type: Object, default: () => { return {}; } }
	},

	data() {
		return {
			id: null,
			type: 'alert',
			style: 'info',
			timeout: null,
			url: null,
			methodType: 'get',
			data: {},
			message: ''
		};
	},

	created() {
		this.init();
	},

	mounted() {
		if (!Helper.isEmpty(this.sessionDialog)) {
			setTimeout(() => {
				scEvent.emit(this.sessionDialog.type, {
					id: 'session-'+this.sessionDialog.type,
					message: this.sessionDialog.message,
					style: this.sessionDialog.style
				});
			}, 500);
		}
	},

	methods: {
		init() {
			scEvent.on('clearTopDialog', this.clear);
			scEvent.on('topAlert', this.alertEvent);
			scEvent.on('topConfirm', this.confirmEvent);
		},

		isType(type) {
			return this.type === type;
		},

		visibleCssClass(type) {
			return {
				active: this.isVisible && this.isType(type)
			};
		},

		clear(data = null) {
			this.clearCountDown();
			this.type = 'alert';
			this.style = 'info';
			this.message = '';
			this.url = null;
			this.methodType = 'get';
			this.data = {};
			this.stopProcessingAjaxCall();

			scEvent.emit(this.id + '-cleared', data || {});
		},

		clearCountDown() {
			if (this.timeout === null) {
				return;
			}

			clearTimeout(this.timeout);
			this.timeout = null;
		},

		alert(data, type) {
			this.clear();
			this.id = data.id;
			this.type = type || this.type;
			this.style = data.style || this.style;
			this.message = data.message;
			this.countDown();
		},

		alertEvent(data) {
			this.alert(data, 'alert');
		},

		confirmEvent(data) {
			this.clear();
			this.id = data.id;
			this.type = 'confirm';
			this.style = data.style || this.style;
			this.message = data.message;

			if (data.url) {
				this.url = data.url;
			}

			if (data.method) {
				this.methodType = data.method.toLowerCase();
			}

			if (data.data) {
				this.data = data.data;
			}
		},

		countDown() {
			this.timeout = setTimeout(() => {
				this.clear();
			}, 7000);
		},

		makeCall() {
			this.startProcessingAjaxCall();

			if (this.url) {
				this.makeAjaxRequest(this.success, this.failure, this.data, this.url, this.methodType);
			} else {
				this.success();
			}
		},

		success(response) {
			scEvent.emit(this.id+'-called', {
				response,
				dialog: this
			});
		},

		failure(error) {
			this.stopProcessingAjaxCall();

			if (error.response) {
				error = 'Error code '+error.response.status+' ('+error.response.statusText+')';
			} else {
				error = error.message;
			}

			this.alertEvent({
				id: this.id,
				type: 'topAlert',
				style: 'danger',
				message: error
			});
		}
	},

	computed: {
		isVisible() {
			return !Helper.isEmpty(this.message);
		},

		wrapperCssClass() {
			return [
				'alert',
				'alert-'+this.style,
				'text-center'
			];
		}
	}
};
</script>

<style>
</style>
