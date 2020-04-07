<script>
import BaseInput from "./BaseInput";

export default {
	mixins: [BaseInput],

	data() {
		return {
			selected: this.initialValue || []
		};
	},

	methods: {
		isSelected(value) {
			return this.selected.includes(value);
		},

		reset() {
			if (this.initialValue) {
				this.emit(this.selected = this.initialValue);
				return;
			}

			this.clear();
		},

		clear() {
			this.emit(this.selected = []);
		}
	}
};
</script>
