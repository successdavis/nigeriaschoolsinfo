<template>
	<div> 
		<button @click="$modal.show('attach-courses')" class="button">Attach Courses</button>
		<modal
			name="attach-courses"
			height="auto"
			:adaptive="true"
			scrollable="scrollable"
		>
			<div class="section">
				<div class="columns">
				  <div class="column">
				    <input @keyup="search" v-model="searchKey" :class="processing ? 'is-loading' : ''" class="input is-rounded" type="text" placeholder="Rounded input">
				  </div>
				</div>
				<p>Fill the box with the cut_of_mark required for the course in this school Before attaching</p>
				<button @click="BatchAttach" class="button" v-show="isBatchAttach">Batch Attach</button>
				<button @click="BatchDetach" class="button" v-show="isBatchDetach">Batch Detach</button>
				<tabs>
					<tab  name="Not Attached" :selected="true">
						<course 
							@checked="notAttachedChecked"
							v-for="(course, index) in notAttachedCourses" 
							:key="index" 
							:school="school" 
							:course="course"
							@linked="courseIsLinked(index)"
						></course>

						<infinite-loading @infinite="infiniteHandler"></infinite-loading>
					</tab>
					<tab  name="attached">
						<course v-for="(course, index) in attachedCourses"
							@checked="AttachedChecked" 
							:key="index" 
							:course="course" 
							:school="school"
							@unlinked="courseIsUnlinked(index)"
						></course>

						<infinite-loading @infinite="infiniteHandler"></infinite-loading>
					</tab>
				</tabs>
			</div>
		</modal>
	</div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
import _ from 'lodash';

	export default {
		 components: {
		    InfiniteLoading,
		 },
		props: {
			school: {
				required: true
			},
		},
		data() {
			return {
				processing: false,
				page: 1,
				courses: [],
				faculties: [],
				faculty: '',
				searchKey: '',
				infiniteId: +new Date(),
				selectallitems: [],
				notAttachedMultiCheck:[],
				AttachedMultiCheck:[]
			}
		},

		computed: {
			attachedCourses() {
				return this.courses.filter(course => course.is_link == true);
			},
			notAttachedCourses() {
				return this.courses.filter(course => course.is_link == false);
			},
			isBatchAttach() {
				return this.notAttachedMultiCheck.length !== 0;
			},
			isBatchDetach() {
				return this.AttachedMultiCheck.length !== 0;
			}
		},

		methods: {
			notAttachedChecked(id,checkstatus){
            // this.items.splice(index, 1);
            	let index = this.notAttachedMultiCheck.indexOf(id)
            	checkstatus 
            	? this.notAttachedMultiCheck.push(id) 
            	: this.notAttachedMultiCheck.splice(index, 1)
			},
			AttachedChecked(id,checkstatus){
            // this.items.splice(index, 1);
            	let index = this.AttachedMultiCheck.indexOf(id)
            	checkstatus 
            	? this.AttachedMultiCheck.push(id) 
            	: this.AttachedMultiCheck.splice(index, 1)
			},
			courseIsLinked(index) {
				this.notAttachedCourses[index].is_link = true;
			},
			courseIsUnlinked(index) {
				this.attachedCourses[index].is_link = false;
			},
			BatchAttach(){
				axios.post(`\\api/attachcoursestoschool/${this.school.slug}`, {
					courses: this.notAttachedMultiCheck
				})
	    		.then (data => {
                    flash('Batch Schools Attached.', 'success');
                    this.notAttachedMultiCheck = [];
                    this.reset();
				})
				.catch(error => {
                    flash('Unable to attach Many, Please contact Admin.', 'failed');
				});
			},
			BatchDetach(){
				console.log('h')
			},

			// This method retrieve all the courses that are not attached to a school
		    infiniteHandler($state) {
		      axios.get(`/courseswithschoolattach/${this.school.slug}`, {
		        params: {
		          page: this.page,
		          faculty: this.faculty,
		          s: this.searchKey,
		        },
		      }).then(({ data }) => {
		        if (data.data.length) {
		          this.page += 1;
		          this.courses.push(...data.data);
		          $state.loaded();
		        } else {
		          $state.complete();
		        }
		      });
		    },

		    changeType() {
		      this.reset();
		    },

		    reset() {
		     	this.page = 1;
		      	this.courses = [];
		      	this.infiniteId += 1;
		      	this.infiniteHandler();
                this.selectallitems = [];
		    },

		    search: _.debounce(function(page) {
                this.processing = true;
                this.reset();
            }, 700),
		},

		created () {
			axios.get('/list-of-faculties/')
    		.then (data => {
    			this.faculties = data.data;
			});

			axios.get(`/courseswithschoolattach/${this.school.slug}`)
    		.then (data => {
    			this.courses = data.data.data;
			});
			
		}
	};
</script>