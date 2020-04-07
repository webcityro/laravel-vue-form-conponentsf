<script>
import Trigger from "./Trigger";

export default {
	mixins: [Trigger],

	props: {
		emit: { type: String, required: false }
	},

	created() {
		scEvent.on('submissionStarted-'+this.group, this.startProcessing);
		scEvent.on('submissionEnded-'+this.group, this.stopProcessing);
	},

	methods: {
		trigger() {
			scEvent.emit(this.emit+'-'+this.group);
		}
	}
};
</script>
