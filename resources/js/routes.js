import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import Posts from './views/Posts.vue';
import AddPost from './views/NewPost.vue';
import Schools from './views/Schools.vue';
import EditSchool from './views/newSchool.vue';
import Courses from './views/Courses.vue';
import newCourse from './views/newCourse.vue';

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
	},

	{
		path: '/courses-offered-in-nigeria-institutions',
		component: Courses
	},

	{
		path: '/addcourse',
		component: newCourse
	},
	{
		path: '/editcourse/:slug',
		component: newCourse,
		name: 'editcourse',
		props: true,
	},


];

export default new VueRouter({
	routes
})