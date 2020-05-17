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
				  <div class="column is-3">
				    <div class="field">
					  <div class="control ">
					    <div class="select is-small">
					      <select v-model="faculty" @change="changeType">
					        <option value="" selected>Sort By (All)</option>
					        <option v-for="faculty in faculties" v-text="faculty.name" :value="faculty.slug"></option>
					      </select>
					    </div>
					  </div>
					</div>
				  </div>
				  <div class="column">
				    <input @keyup="search" v-model="searchKey" :class="processing ? 'is-loading' : ''" class="input is-rounded" type="text" placeholder="Rounded input">
				  </div>
				  <div class="column is-2">
				    <span style="cursor: pointer" @click="selectall">Select All</span>
				  </div>
				</div>
				<p>Fill the box with the cut_of_mark required for this course in this school Before attaching</p>
				<tabs>
					<tab name="Not Attached" :selected="true">
						<course 
							v-for="(course, index) in notAttachedCourses" 
							:key="index" 
							:school="school" 
							:course="course"
							@linked="courseIsLinked(index)"
						></course>

						<infinite-loading @infinite="infiniteHandler"></infinite-loading>
					</tab>
					<tab name="attached">
						<course v-for="(course, index) in attachedCourses" 
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
			}
		},

		computed: {
			attachedCourses() {
				return this.courses.filter(course => course.is_link == true);
			},
			notAttachedCourses() {
				return this.courses.filter(course => course.is_link == false);
			},
		},

		methods: {
			courseIsLinked(index) {
				this.notAttachedCourses[index].is_link = true;
			},
			courseIsUnlinked(index) {
				this.attachedCourses[index].is_link = false;
			},
			selectall() {
				this.notAttachedCourses.forEach(school => {
					this.selectallitems.push(school.id);
				})

				this.attachMany();
			},
			attachMany(){
				axios.post(`\\api/schoolcourseattachmany/${this.course.slug}`, {
					schools: this.selectallitems
				})
	    		.then (data => {
                    flash('Batch Schools Create.', 'success');
                    this.reset();
				})
				.catch(error => {
                    flash('Unable to attach Many, Please contact Admin.', 'failed');
				});
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