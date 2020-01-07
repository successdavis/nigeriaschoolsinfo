<template>
	<div>
		<button @click="$modal.show('attach-subject')" class="button">Set Utme Subjects</button>
		<modal
			name="attach-subject"
			height="auto"
			:adaptive="true"
			scrollable="scrollable"
		>
			<div class="section">
				<div class="has-text-centered is-size-4">Previous Subjects</div>
				<div>* English Language</div>
				<div v-for="subject in previoussubjects" v-text="'* ' + subject.name"></div>
	            <div class="is-size-4 has-text-centered mb-medium">Required Jamb Subjects</div>
	            <div class="field is-horizontal">
	              <div class="field-label is-normal">
	                <label class="label">One</label>
	              </div>
	              <div class="field-body">
	                <div class="field">
	                  <div class="control">
	                    <div class="select is-fullwidth">
	                      <select v-model="one">
	                        <option>Select Subject</option>
	                        <option v-for="subject in subjects" v-if="subject.name != 'English Language'" v-text="subject.name" :value="subject.id">Business development</option>
	                      </select>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	            <div class="field is-horizontal">
	              <div class="field-label is-normal">
	                <label class="label">Two</label>
	              </div>
	              <div class="field-body">
	                <div class="field">
	                  <div class="control">
	                    <div class="select is-fullwidth">
	                      <select v-model="two">
	                        <option>Select Subject</option>
	                        <option v-for="subject in subjects" v-text="subject.name" :value="subject.id">Business development</option>
	                      </select>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	            <div class="field is-horizontal">
	              <div class="field-label is-normal">
	                <label class="label">Three</label>
	              </div>
	              <div class="field-body">
	                <div class="field">
	                  <div class="control">
	                    <div class="select is-fullwidth">
	                      <select v-model="three">
	                        <option>Select Subject</option>
	                        <option v-for="subject in subjects" v-text="subject.name" :value="subject.id">Business development</option>
	                      </select>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	            <div class="has-text-centered">
		            <button @click="postsubjects" class="button mt-small is-link is-rounded is-centered">Update Subjects</button>
	            </div>
	        </div>
     	</modal>
	</div>
	
</template>

<script>
	export default {
		props: ['course'],
		data () {
			return {
				subjects: [],
				selectedSubjects: [],
				previoussubjects: [],
				one: '',
				two: '',
				three: '',
			}
		},

		created () {
			axios.get('/newcourse/courserequirements')
    		.then (data => {
    			this.subjects = data.data.subjects;
			});

			this.getsubjects();
		},

		computed: {
			getSelectedSubjects() {
				return [this.one, this.two, this.three]
			}
		},


		methods: {
			getsubjects() {
				axios.get(`/api/${this.course.slug}/getsubjects`)
	    		.then (data => {
	    			this.previoussubjects = data.data;
				});
			},

			postsubjects() {
				axios.post(`/api/${this.course.slug}/attachManySubject`, {
					subjects: this.getSelectedSubjects,
				})
				.then (data => {
					this.getsubjects();
					flash('Subjects Updated Successfully', 'success');
				})
				.catch(error => {
					flash('Error! Please review select subjects', 'failed');
				})
			}
		}
	}
</script>