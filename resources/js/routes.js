import VueRouter from 'vue-router';
import Home from './views/Home.vue';

let routes = [
	{
		path: '/',
		component: Home
	}

];

export default new VueRouter({
	routes
})