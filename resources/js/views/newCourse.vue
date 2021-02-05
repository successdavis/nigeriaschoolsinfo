<template>
	<div class="container">
		<div v-show="course !== '' ">
			<button class="button" @click="createNew">Add new course</button>
			<attach-subjects :course="course"></attach-subjects>
		</div>	
	    <div v-if="showMatchedWarning">
			<span class="is-size-5">Wait! These Courses are similar to your new Course</span>
			<ul>
				<li v-for="course in matchedCourses" v-text="'* ' + course.name"></li>
			</ul>
			<span>Do you still want to continue?</span> 
			<button @click="matchedCourses = ''">Yes</button>
			<button @click="$modal.hide('new-Course')">No</button>
		</div>
		<div v-show="showErrors" class="is-danger">Your Form contain errors Please review all steps</div>
			<form @submit.prevent="createCourse" @change="errorMessage=''" novalidate>
				<div v-show="steps == 1">
						<div class="is-size-4 has-text-centered	mb-small">Basic Information</div>
						
						<center class="section">
							<label class="checkbox" v-for="programme in programmes">
							  <input type="checkbox" v-model="courseForm.selectedprogrammes" :value="programme.id">
							  {{programme.name}} 
							</label>
					      <p class="help is-danger" v-if="courseForm.errors.has('selectedprogrammes')" v-text="courseForm.errors.get('selectedprogrammes')"></p>
						</center>


						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Name</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input v-model="courseForm.name" @change="findCourses" class="input" type="text" placeholder="Enter Course Name">
						      </div>
						      <p class="help is-danger" v-if="courseForm.errors.has('name')" v-text="courseForm.errors.get('name')">
						      </p>
						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Shortname</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input @change="findCourses" v-model="courseForm.short_name" class="input" type="text" placeholder="E.g EDUTECH">
						      </div>
						      <p class="help is-danger" v-if="courseForm.errors.has('short_name')" v-text="courseForm.errors.get('short_name')"></p>
						      </p>
						    </div>
						  </div>
						</div>


						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">*Faculty</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <div class="select is-fullwidth">
						          <select v-model="courseForm.faculty_id">
						            <option value="">Select a type</option>
						            <option v-for="faculty in faculties" :value="faculty.id" v-text="faculty.name"></option>
						          </select>
						        </div>
						      </div>
						      <p class="help is-danger" v-if="courseForm.errors.has('faculty_id')" v-text="courseForm.errors.get('faculty_id')"></p>

						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">Duration</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input min="0" max="15" v-model="courseForm.duration" class="input" type="number" placeholder="Enter Points">
						      </div>
						      <p class="help is-danger" v-if="courseForm.errors.has('duration')" v-text="courseForm.errors.get('duration')"></p>
						      
						    </div>
						  </div>
						</div>

						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">Cut off Point</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input min="0" max="15" v-model="courseForm.cut_off_point" class="input" type="number" placeholder="Enter Points">
						      </div>
						      <p class="help is-danger" v-if="courseForm.errors.has('cut_off_point')" v-text="courseForm.errors.get('cut_off_point')"></p>
						      
						    </div>
						  </div>
						</div>
						<div class="field is-horizontal">
						  <div class="field-label is-normal">
						    <label class="label">Salary</label>
						  </div>
						  <div class="field-body">
						    <div class="field">
						      <div class="control">
						        <input v-model="courseForm.salary" class="input" type="number" placeholder="Enter Points">
						      </div>
						      <p class="help is-danger" v-if="courseForm.errors.has('salary')" v-text="courseForm.errors.get('salary')"></p>
						      
						    </div>
						  </div>
						</div>
				</div>
				<div v-show="steps == 2">
					<div class="is-size-4 has-text-centered	mb-small">Bio Data</div>

					<div class="field is-horizontal">
					  <div class="field-label is-normal">
					    <label class="label">*Description</label>
					  </div>
					  <div class="field-body">
					    <div class="field">
					      <div class="control">
						  	
						  	<editor :value="courseForm.description" @content="setCourseBody"></editor>

					      </div>
					      <p class="help is-danger" v-if="courseForm.errors.has('description')" v-text="courseForm.errors.get('description')"></p>

					    </div>
					  </div>
					</div>
				</div>
				<div v-show="steps == 3">

					<div class="is-size-4 has-text-centered	mb-small">Jamb Specs</div>
					<div class="field is-horizontal">
					  <div class="field-label is-normal">
					    <label class="label">Utme Comment</label>
					  </div>
					  <div class="field-body">
					    <div class="field">
					      <div class="control">
					        <textarea v-model="courseForm.utme_comment" class="textarea" placeholder="Please indicate which other subject(s) can be conbined here. Be brief"></textarea>
					      </div>
					      <p class="help is-danger" v-if="courseForm.errors.has('utme_comment')" v-text="courseForm.errors.get('utme_comment')"></p>
					    </div>
					  </div>
					</div>
					<div class="field is-horizontal">
					  <div class="field-label is-normal">
					    <label class="label">*Utme Requirement</label>
					  </div>
					  <div class="field-body">
					    <div class="field">
					      <div class="control">
					        <textarea v-model="courseForm.utme_requirement" class="textarea" placeholder="Write here the utme requirements for this course"></textarea>
					      </div>
					      <p class="help is-danger" v-if="courseForm.errors.has('utme_requirement')" v-text="courseForm.errors.get('utme_requirement')"></p>

					    </div>
					  </div>
					</div>
					<div class="field is-horizontal">
					  <div class="field-label is-normal">
					    <label class="label">*Direct Entry Requirement</label>
					  </div>
					  <div class="field-body">
					    <div class="field">
					      <div class="control">
					        <textarea v-model="courseForm.direct_requirement" class="textarea" placeholder="Write here the requirement for direct entry admission"></textarea>
					      </div>
					      <p class="help is-danger" v-if="courseForm.errors.has('direct_requirement')" v-text="courseForm.errors.get('direct_requirement')"></p>
					    </div>
					  </div>
					</div>
					<div class="field is-horizontal">
					  <div class="field-label is-normal">
					    <label class="label">*Special Considerations</label>
					  </div>
					  <div class="field-body">
					    <div class="field">
					      <div class="control">
					        <textarea v-model="courseForm.considerations" class="textarea" placeholder="Please state the considerations for each school"></textarea>
					      </div>
					      <p class="help is-danger" v-if="courseForm.errors.has('considerations')" v-text="courseForm.errors.get('considerations')"></p>
					    </div>
					  </div>
					</div>


					<div class="field is-horizontal">
					  <div class="field-label">
					    <!-- Left empty for spacing -->
					  </div>
					  <div class="field-body">
					    <div class="field is-fullwidth">
					      <div class="control">
					        <button type="submit" class="button is-primary"
						        v-text="course ? 'Update Course' : 'Create Course' "
					        >
					        </button>
					      </div>
					    </div>
					  </div>
					</div>
				</div>
			</form>
				<div v-if="!showMatchedWarning" class="mt-medium buttons is-centered">
					<button type="button" class="button" @click="steps --" :disabled="steps === 1">Prev</button>
					<button type="button" class="button" @click="steps ++" :disabled="steps === max_steps">Next</button>
				</div>
		</div>
			<!-- <button class="button" @click="creatingNew = true">Attach Schools</button> -->
	</div>
</template>

<script>
	import Editor from '../components/editor';

	export default {
		components: {
	      Editor
	    },
		data() {
			return {
				course: '',
				faculties: [],
				programmes: [],
				showErrors: false,
				errorMessage: '',
				matchedCourses: [],
				adaptive: true,
				steps: 1,
				max_steps: 3,
				courseForm: new Form ({
					name: '',
					short_name: '',
					faculty_id: '',
					description: '',
					logo_path: '',
					salary: '', 
					duration: '',
					utme_comment: '',
					utme_requirement: '',
					direct_requirement: '',
					considerations: '',
					meta_description: '',
					cut_off_point: '',
					selectedprogrammes: [],
				}),
			}
		},

		methods: {
			setData(course) {
				if (course) {
					
					this.course = course.data.data
						this.courseForm.name 			 = course.data.data.name
						this.courseForm.short_name 		 = course.data.data.short_name
						this.courseForm.description 	 = course.data.data.description
						this.courseForm.meta_description = course.data.data.meta_description
						this.courseForm.faculty_id = course.data.data.faculty.id
						this.courseForm.logo_path = course.data.data.logo_path
						this.courseForm.salary = course.data.data.salary
						this.courseForm.duration = course.data.data.duration
						this.courseForm.utme_comment = course.data.data.utme_comment
						this.courseForm.utme_requirement = course.data.data.utme_requirement
						this.courseForm.direct_requirement = course.data.data.direct_requirement
						this.courseForm.considerations = course.data.data.considerations
						this.courseForm.cut_off_point = course.data.data.cut_off_point
						this.courseForm.selectedprogrammes = course.data.data.programmes
			    } else {
			        console.log('failed')
			    }
			},
			setCourseBody (value) {
				this.courseForm.description = value;
			},
			createCourse() {
				this.showErrors = false;
				if (this.course == '') {
					this.courseForm.post('/courses/createcourse')
                    .then(data => {
                    		this.steps = 1;
                            this.courseForm.reset();
                            this.course = data;
                            flash('Course created.', 'success');
                    })
	                .catch(error => {
	                	this.showErrors = true;
	                    flash(error.message, 'failed');
	                });
				}else {
					this.courseForm.patch(`/updatecourse/${this.course.slug}`)
                    .then(data => {
                            flash('Course updated.', 'success');
                    })
	                .catch(error => {
	                	this.showErrors = true;
	                    flash(error.message, 'failed');
	                });
				}
	        },

	        createNew() {
	        	this.course = ''
	        	this.steps = 1,
	        	this.courseForm.name 			 = ''
				this.courseForm.short_name 		 = ''
				this.courseForm.description 	 = ''
				this.courseForm.meta_description = ''
				this.courseForm.faculty_id 		 = ''
				this.courseForm.logo_path 		 = ''
				this.courseForm.salary 			 = ''
				this.courseForm.duration 		 = ''
				this.courseForm.utme_comment 	 = ''
				this.courseForm.utme_requirement = ''
				this.courseForm.direct_requirement = ''
				this.courseForm.considerations 	 = ''
	        },

			findCourses () {
	    		axios.get('/find/courses', {params: {name: this.courseForm.name, short_name: this.courseForm.short_name}})
	    			.then (data => {
	    				this.matchedCourses = data.data;
	    			});
	    	},
		},

		computed: {
			showMatchedWarning () {
				if (this.matchedCourses === undefined || this.matchedCourses.length == 0) {
				    return false;
				}
				return true;
			}
		},

		created () {
			axios.get('/newcourse/courserequirements')
    		.then (data => {
    			this.faculties = data.data.faculties;
			});
			axios.get('/educationlevels')
    		.then (data => {
    			console.log(data.data);
    			this.programmes = data.data;
			});
		},
		beforeRouteEnter (to, from, next) {
	  		if (to.params.slug) {
		    	axios.get(`/editcourse/${to.params.slug}`)
	    		.then (data => {
	    			next(vm => vm.setData(data));
	    		})
	    		.catch(() => {
			  		flash('This Course cannot be edited at this time');
	    			return false
	    		})
	  		}else {
		  		next();
	  		}
	  	},
	}
</script>

<style scoped>
	.ps-container {
		padding: 1.5em;
	}

	.top-right {
		position: absolute;
	    top: 5px;
	    right: 5px;
	}
</style>