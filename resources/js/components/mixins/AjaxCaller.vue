<script>
import Processor from "./Processor";

export default {
	mixins: [Processor],

	props: {
		action: { type: String, required: false, default: '/' },
		method: { type: String, required: false, default: 'post' }
	},

	methods: {
		makeAjaxCall(success, failure) {
			this.startProcessingAjaxCall();
			this.makeAjaxRequest(success, failure);
		},

		startProcessingAjaxCall() {
			this.startProcessing();
			this.startProcessingAjaxCallEvent();
		},

		startProcessingAjaxCallEvent() {},

		stopProcessingAjaxCall() {
			this.stopProcessing();
			this.stopProcessingAjaxCallEvent();
		},

		stopProcessingAjaxCallEvent() {},

		makeAjaxRequest(success, failure, data, url, method) {
			const requestData = {
				url: url || this.endpoint,
				method: (method || this.method).toLowerCase(),
				params: {},
				data: {}
			};

			if (['post', 'put', 'patch'].includes(requestData.method)) {
				requestData.data = data || this.requestData;
			} else {
				requestData.params = data || this.requestData;
			}

			axios.request(requestData).then(success).catch(failure);
		}
	},

	computed: {
		endpoint() {
			return this.action;
		},

		requestData() {
			return {};
		}
	}
};
</script>
