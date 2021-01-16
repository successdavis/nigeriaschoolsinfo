import Vue from 'vue'
window.Vue = Vue;
require('./bootstrap'); 
import router from './routes';


Vue.component('Flash', require('./components/Flash.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('drawer-menu', require('./components/DrawerMenu.vue').default);
Vue.component('menu-item', require('./components/menuitem.vue').default);
Vue.component('ask-question', require('./components/AskQuestion.vue').default);
Vue.component('image-carousel', require('./components/carousel.vue').default);
Vue.component('shools-page', require('./pages/schools.vue').default);
Vue.component('exams-page', require('./pages/exams.vue').default);
Vue.component('courses-page', require('./pages/courses.vue').default);
// Vue.component('new-post', require('./views/NewPost.vue').default);
Vue.component('paginator', require('./components/paginator.vue').default);
Vue.component('course_quick_view', require('./components/CourseQuickView.vue').default);
Vue.component('school-images', require('./components/SchoolImages.vue').default);
Vue.component('attach-schools', require('./components/attachSchool.vue').default);
Vue.component('attach-courses', require('./components/attachCourseToSchool.vue').default);
Vue.component('attach-subjects', require('./components/attachSubjects.vue').default);
Vue.component('special-consideration', require('./components/SpecialConsideration.vue').default);
Vue.component('tabs', require('./components/tabs.vue').default);
Vue.component('tab', require('./components/tab.vue').default);
Vue.component('datatable', require('./components/datatable.vue').default);
Vue.component('school', require('./components/school.vue').default);
Vue.component('course', require('./components/course.vue').default);
Vue.component('school-quickview', require('./components/schoolQuickView.vue').default);
Vue.component('related-post', require('./components/relatedPost.vue').default);
Vue.component('comments', require('./components/comments.vue').default);
// Vue.component('comment', require('./components/comment.vue').default);
Vue.component('reactivity', require('./components/Reactivity.vue').default);
Vue.component('project-material', require('./pages/ProjectMaterial.vue').default);
Vue.component('paystack-payment', require('./components/PaystackInlinePayment.vue').default);
Vue.component('new-job', require('./components/NewJob.vue').default);
Vue.component('new-scholarship', require('./components/NewScholarship.vue').default);

const app = new Vue({
    el: '#app',

    router
});
