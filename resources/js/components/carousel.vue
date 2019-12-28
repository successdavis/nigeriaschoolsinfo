<template>
	<div>
		<slot></slot>
	</div>
	
</template>

<script>
	import Flickity from 'flickity';
	import 'flickity/dist/flickity.min.css';

	export default {
		props: {
			autoplay: {default: false},
			wraparound: {default: false},
		},

		mounted() {
			new Flickity(this.$el, {
				wrapAround: this.wraparound,
				autoPlay: this.autoplay,
				contain: true,
				cellAlign: 'left'
			});
		}

	}
</script>