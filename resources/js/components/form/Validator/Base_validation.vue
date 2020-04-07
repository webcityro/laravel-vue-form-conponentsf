<template>
	<div v-if="show">
		<div
			v-for="(message, rule) in validation"
			:key="rule"
			v-show="showError(rule)"
		>
			<span :class="cssClass">{{ message }}</span>
		</div>
	</div>
</template>

<script>
import Error from "./Error";

export default {
	props: {
		label: { type: String, required: false },
		name: { type: String, required: true },
		id: { type: String, required: false },
		show: { type: Boolean, default: false },
		cssClass: { type: [Array, Object, String], required: false, default: 'invalid-feedback' },
		validation: { type: [Array, Object], default: () => [] },
		error: { type: Object, default: () => new Error },
	},

	methods: {
		showError(rule) {
			return this.error.has(this.name, rule.split(':')[0]);
		}
	}
};
</script>

<style scoped>
.invalid-feedback {
	display: block;
}
</style>
