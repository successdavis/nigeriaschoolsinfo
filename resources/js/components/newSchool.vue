<script>
import _ from 'lodash';
  import Editor from '../components/editor';

export default {
	components: {
      Editor
    },
	data () {
		return {
			school: '',
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
				name: '',
				short_name: '',
				school_type_id: '',
				sponsored_id: '',
				website: '',
				portal_website: '',
				jamb_points: '',
				states_id: '',
				lga_id: '',
				address: '',
				phone: '',
				email: '',
				short_name: '',
				description: '',
			}),
		}
	},

	methods: {
		setPostBody (value) {
				this.schoolForm.description = value;
			},
		createSchool() {
			this.showErrors = false;
			this.schoolForm.post('/schools/createschool')
                    .then(data => {
                    		this.school = data;
                            // this.schoolForm.reset();
                            this.steps = 2;
                            flash('School Successfully created.', 'success');
                    })
                .catch(error => {
                	this.errorMessage = error.errors;
                	this.showErrors = true;
                    flash('We were unable to process your form', 'failed');
                });
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