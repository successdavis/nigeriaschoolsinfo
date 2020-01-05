<template>
	<div>
		<slot v-if="isActive"></slot>
	</div>
</template>

<script>
export default {
	props: {
		name: { required: true},
		selected: {default: false}	
	},

	data () {
		return {
			isActive: false,
		}
	},

	computed: {
		href() {
			return '#' + this.name.toLowerCase().replace(/ /g, '_');
		}
	},

	mounted () {
		this.isActive = this.selected;
	}
}
</script>