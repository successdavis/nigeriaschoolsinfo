<template>
	<ul>
		<li v-for="item in items">{{item}}</li>
	</ul>
</template>
<script>
	export default {
		data() {
			return {
				items: ['oranges','apples','pineables'],
			}
		},

		methods: {

		}
	}
</script>