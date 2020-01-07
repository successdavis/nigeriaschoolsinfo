/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap'); 



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('Flash', require('./components/Flash.vue').default);
Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('ask-question', require('./components/AskQuestion.vue').default);
Vue.component('streamer-carousel', require('./components/StreamerCarousel.vue').default);
Vue.component('image-carousel', require('./components/carousel.vue').default);
Vue.component('shools-page', require('./pages/schools.vue').default);
Vue.component('exams-page', require('./pages/exams.vue').default);
Vue.component('courses-page', require('./pages/courses.vue').default);
Vue.component('paginator', require('./components/paginator.vue').default);
Vue.component('course_quick_view', require('./components/CourseQuickView.vue').default);
Vue.component('new-school', require('./components/newSchool.vue').default);
Vue.component('new-course', require('./components/newCourse.vue').default);
Vue.component('attach-schools', require('./components/attachSchool.vue').default);
Vue.component('attach-subjects', require('./components/attachSubjects.vue').default);
Vue.component('tabs', require('./components/tabs.vue').default);
Vue.component('tab', require('./components/tab.vue').default);
Vue.component('school', require('./components/school.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
