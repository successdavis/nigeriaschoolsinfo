<template>
	<div>
		<div class="mb-small is-size-6" v-for="post in posts"><a :href="post.path" v-text="post.title"></a></div>
		
	</div>
</template>
<script>
	export default {
		props: ['module', 'module_id'],
		data () {
			return {
				posts: [],
			}
		},

		created () {
			axios.get('/posts/relatedpost', {
				params: {
					module: this.module,
					module_id: this.module_id
				}
			})
			.then(data => {
				this.posts = data.data.data;
			})
			.catch(error => {
				console.log('Admin? you have a bug to fix');
			})
		}
	}
</script>