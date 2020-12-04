import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import Posts from './views/Posts.vue';
import AddPost from './views/NewPost.vue';

let routes = [
	{
		path: '/',
		component: Home
	},

	{
		path: '/posts',
		component: Posts
	},

	{
		path: '/addpost',
		component: AddPost
	},

	{
		path: '/editpost/:slug',
		component: AddPost,
		name: 'editpost',
		props: true,
	},
	// {
	// 	path: '/schools',
	// 	component: Posts
	// },

	// {
	// 	path: '/addschool',
	// 	component: AddPost
	// },

	// {
	// 	path: '/editschool/:slug',
	// 	component: AddPost,
	// 	name: 'editpost',
	// 	props: true,
	// }

];

export default new VueRouter({
	routes
})