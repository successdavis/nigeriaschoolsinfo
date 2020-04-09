<template>
	<div>	
		<input type="text" name="" v-model="newItem">
		<input type="submit" @click="add">
		<ul v-if="show">
			<li v-for="item in items" v-text="item"></li>
		</ul>
	</div>
</template>

<script>
	export default {
		data () {
			return {
				show: false,
				newItem: '',
				items: [],
			}
		},

		methods: {
			add() {
				// this.items['a'] = this.newItem;
				this.$set(this.items, 'a', this.newItem);
			}
		}
	};
</script>

