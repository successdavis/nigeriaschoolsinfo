import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import Posts from './views/Posts.vue';
import AddPost from './views/NewPost.vue';
import Schools from './views/Schools.vue';
import EditSchool from './views/newSchool.vue';

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
	
	{
		path: '/schools',
		component: Schools
	},

	{
		path: '/addschool',
		component: EditSchool
	},
	{
		path: '/editschool/:slug',
		component: EditSchool,
		name: 'editschool',
		props: true,
	}

];

export default new VueRouter({
	routes
})