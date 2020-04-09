require('./bootstrap'); 



Vue.component('Flash', require('./components/Flash.vue').default);
Vue.component('nav-bar', require('./components/NavBar.vue').default);
Vue.component('ask-question', require('./components/AskQuestion.vue').default);
Vue.component('streamer-carousel', require('./components/StreamerCarousel.vue').default);
Vue.component('image-carousel', require('./components/carousel.vue').default);
Vue.component('shools-page', require('./pages/schools.vue').default);
Vue.component('exams-page', require('./pages/exams.vue').default);
Vue.component('courses-page', require('./pages/courses.vue').default);
Vue.component('new-post', require('./pages/NewPost.vue').default);
Vue.component('paginator', require('./components/paginator.vue').default);
Vue.component('course_quick_view', require('./components/CourseQuickView.vue').default);
Vue.component('new-school', require('./components/newSchool.vue').default);
Vue.component('new-course', require('./components/newCourse.vue').default);
Vue.component('attach-schools', require('./components/attachSchool.vue').default);
Vue.component('attach-subjects', require('./components/attachSubjects.vue').default);
Vue.component('special-consideration', require('./components/SpecialConsideration.vue').default);
Vue.component('tabs', require('./components/tabs.vue').default);
Vue.component('tab', require('./components/tab.vue').default);
Vue.component('school', require('./components/school.vue').default);
Vue.component('school-quickview', require('./components/schoolQuickView.vue').default);
Vue.component('related-post', require('./components/relatedPost.vue').default);
Vue.component('comments', require('./components/comments.vue').default);
Vue.component('comment', require('./components/comment.vue').default);
Vue.component('reactivity', require('./components/Reactivity.vue').default);

const app = new Vue({
    el: '#app',
});
