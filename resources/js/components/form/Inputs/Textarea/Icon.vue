<template>
	<button
		type="button"
		class="menubar__button"
		:class="{ 'is-active': isActive }"
		:disabled="isDisabled"
		@click="menu.commands[cmd](args)"
	>
		<div class="icon" :class="[`icon--${name}`, `icon--${size}`, { 'has-align-fix': fixAlign }]">
			<slot>
				<img :src="imgSRC" :alt="name" />
			</slot>
		</div>
	</button>
</template>

<script>
export default {
	props: {
		menu: { type: Object, required: true },
		cmd: { type: String, required: true },
		args: { required: false },
		name: { type: String, required: false },
		img: { type: String, required: false },
		size: { type: String, required: false, default: 'normal' },
		modifier: { type: String, required: false, default: null },
		fixAlign: { type: Boolean, required: false, default: true },
		isDisabled: { type: Boolean, required: false, default: false },
	},

	mounted() {
	},

	computed: {
		imgSRC() {
			return `/images/editor_icons/${this.img}.svg`;
		},

		isActive() {
			return typeof this.menu.isActive[this.cmd] === 'function' ? this.menu.isActive[this.cmd](this.args) : false;
		}
	}
}
</script>

<style lang="scss" scoped>
.menubar__button {
    font-weight: 700;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    background: transparent;
    border: 0;
    color: #000;
    padding: .2rem .5rem;
    margin-right: .2rem;
    border-radius: 3px;
    cursor: pointer;
}

.menubar__button.is-active {
	background-color: #fdfdfd;
}

.icon {
	position: relative;
	display: inline-block;
	vertical-align: middle;
	min-width: 0.8rem;
	height: 0.8rem;
	margin: 0 0.3rem;
	top: -0.05rem;
	fill: currentColor;

	&:first-child {
		margin-left: 0;
	}
	&:last-child {
		margin-right: 0;
	}

	img {
		max-width: 100%;
		max-height: 100%;
	}
}

button[disabled],
button[disabled] .icon {
	opacity: .5;
	pointer-events: none;
	cursor: not-allowed;
}
</style>
