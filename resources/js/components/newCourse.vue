<template>
	<div class="container">
		<button @click="$modal.show('new-course')" class="button">ADD COURSE</button>
		<modal
			name="new-course"
			height="auto"
			:adaptive="adaptive"
			scrollable="scrollable"
		>
		<div v-if="creatingNew" class="section">
			<div slot="top-right" class="top-right relative-body">
				<button @click="$modal.hide('new-course')">
		       		❌
		     	</button>
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
				<form @submit.prevent="createCourse" @change="errorMessage=''">
					<div v-show="steps == 1">
							<div class="is-size-4 has-text-centered	mb-small">Basic Information</div>
							<div class="field is-horizontal">
							  <div class="field-label is-normal">
							    <label class="label">*Name</label>
							  </div>
							  <div class="field-body">
							    <div class="field">
							      <div class="control">
							        <input v-model="courseForm.name" @change="findCourses" required class="input" type="text" placeholder="Enter Course Name">
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
							        <input @change="findCourses" v-model="courseForm.short_name" required class="input" type="text" placeholder="E.g EDUTECH">
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
							          <select v-model="courseForm.faculty_id" required>
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
							        <input v-model="courseForm.duration" class="input" type="number" placeholder="Enter Points">
							      </div>
							      <p class="help is-danger" v-if="courseForm.errors.has('duration')" v-text="courseForm.errors.get('duration')"></p>
							      
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
						        <textarea v-model="courseForm.description" required class="textarea" placeholder="Write all about the course here"></textarea>
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
						        <textarea v-model="courseForm.utme_comment" required class="textarea" placeholder="Please indicate which other subject(s) can be conbined here. Be brief"></textarea>
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
						        <textarea v-model="courseForm.utme_requirement" required class="textarea" placeholder="Write here the utme requirements for this course"></textarea>
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
						        <textarea v-model="courseForm.direct_requirement" required class="textarea" placeholder="Write here the requirement for direct entry admission"></textarea>
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
						        <textarea v-model="courseForm.considerations" required class="textarea" placeholder="Please state the considerations for each school"></textarea>
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
						        <button type="submit" class="button is-primary">
						          CREATE COURSE
						        </button>
						      </div>
						    </div>
						  </div>
						</div>
					</div>
				</form>
					<div v-if="!showMatchedWarning" class="mt-medium buttons is-centered">
						<button class="button" @click="steps --" :disabled="steps === 1">Prev</button>
						<button class="button" @click="steps ++" :disabled="steps === max_steps">Next</button>
					</div>
			</div>
		<div class="section" v-else>
			<div v-if="attachingSchools">
				
			</div>
			<!-- <button class="button" @click="creatingNew = true">Attach Schools</button> -->
			<button class="button" @click="creatingNew = true">Edit Course</button>
			<button class="button" @click="creatingNew = true">Add new course</button>
		</div>
		</modal>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				attachingSchools: false,
				course: '',
				creatingNew: true,
				faculties: [],
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
				}),
			}
		},

		methods: {
			createCourse() {
				this.showErrors = false;
				this.courseForm.post('/courses/createcourse')
                    .then(data => {
                    		this.creatingNew = false;
                    		this.steps = 1;
                            this.courseForm.reset();
                            this.course = data;
                            flash('Course created.', 'success');
                    })
	                .catch(error => {
	                	this.errorMessage = error.errors;
	                	this.showErrors = true;
	                    flash('We were unable to process your form', 'failed');
	                });
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
		}
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