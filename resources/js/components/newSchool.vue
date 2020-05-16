<script>
import _ from 'lodash';
  import Editor from '../components/editor';

export default {
	components: {
      Editor
    },
    props: ['data'],
	data () {
		return {
			processing: false,
			school: this.data,
			errorMessage: '',
			showErrors: false,
			steps: 1,
			max_steps: 3,
			types: [],
			sponsored: [],
			states: [],
			lgas: [],
			adaptive: true,
			matchedSchools: '',
			schoolForm: new Form ({
				name: this.data != null ? this.data.name : '',
				short_name: this.data ? this.data.short_name : '',
				school_type_id: this.data ? this.data.school_type_id : '',
				sponsored_id: this.data ? this.data.sponsored_id : '',
				website: this.data ? this.data.website : '',
				portal_website: this.data ? this.data.portal_website : '',
				jamb_points: this.data ? this.data.jamb_points : '',
				states_id: this.data ? this.data.states_id : '',
				lga_id: this.data ? this.data.lga_id : '',
				address: this.data ? this.data.address : '',
				phone: this.data ? this.data.phone : '',
				email: this.data ? this.data.email : '',
				// short_name: this.school ? this.school.states_id : '',
				description: this.data ? this.data.description : '',
			}),
		}
	},

	methods: {
		setPostBody (value) {
				this.schoolForm.description = value;
			},
		createSchool() {
    		this.processing = true;
			if (this.school) {
				this.showErrors = false;
	        	this.schoolForm.patch(`/schools/${this.school.slug}/update`)
	        	.then(data => {
		    		this.processing = false;
	        		flash('School data update was successful')
	        	})
	        	.catch(error => {
	        		this.errorMessage = error.errors;
	            	this.showErrors = true;
		    		this.processing = false;
	        		flash('Something went wrong with updating this school','failed');
	        	})
			}
			else {
				this.showErrors = false;
				this.schoolForm.post('/schools/createschool')
                    .then(data => {
                    		this.school = data;
                            // this.schoolForm.reset();
                            this.steps = 2;
				    		this.processing = false;
                            flash('School Successfully created.', 'success');
                    })
                .catch(error => {
                	this.errorMessage = error.errors;
                	this.showErrors = true;
		    		this.processing = false;
                    flash('We were unable to process your form', 'failed');
                });
	        }
        },

	    findSchool () {
	    	axios.get('/find/school', {params: {s: this.schoolForm.name, sn: this.schoolForm.short_name}})
	    		.then (data => {
	    			this.matchedSchools = data.data;
	    		});
	    },

	    statelgas () {
	    	axios.get('/api/statelocalgovernments', {params: {local: this.schoolForm.states_id}})
	    		.then (data => {
	    			this.lgas = data.data;
	    		});
	    },
	},

	created () {
		axios.get('/createSchoolRequirements/')
    		.then (data => {
    			this.states = data.data.States;
    			this.sponsored = data.data.Sponsored;
    			this.types = data.data.Types;
			});

    	this.data ? this.statelgas() : '';
	},

	computed: {
		showMatchedWarning () {
			if (this.matchedSchools === undefined || this.matchedSchools.length == 0) {
			    return false;
			}
			return true;
		}
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