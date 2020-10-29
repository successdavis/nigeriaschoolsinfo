import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import Posts from './views/Posts.vue';

let routes = [
	{
		path: '/',
		component: Home
	},

	{
		path: '/posts',
		component: Posts
	}

];

export default new VueRouter({
	routes
})