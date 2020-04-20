<script>
  import Editor from '../components/editor';
	export default {
		components: {
	      Editor
	    },
	    props: ['job'],
		data () {
			return {
				jobhandler: this.job,
				processing: false,
				postData: new Form({
					title: this.job != null ? this.job.title : '',
					description: this.job != null ? this.job.description : '',
					portal_website: this.job != null ? this.job.portal_website : '',
					phone: this.job != null ? this.job.phone : '',
					location: this.job != null ? this.job.location : '',
					employer:this.job != null ? this.job.employer : '',
					ends_at:this.job != null ? this.job.ends_at : '',

				}),
			}
		},

		methods: {
			setPostBody (value) {
				this.postData.description = value;
			},
			publishJob(){
				this.processing = true;
				if (!this.jobhandler) {
					this.postData.post('/jobs/create')
					.then(data => {
						flash('Your new project has been created', 'success')
						this.jobhandler = data;
						this.processing = false;
					})
					.catch(error => {
						flash('Something went wrong submitting your data', 'failed')
						this.processing = false;
					});
				}else {
					this.postData.patch(`/jobs/${this.jobhandler.slug}/update`)
					.then(data => {
						flash('Job Updated', 'success')
						this.processing = false;
					})
					.catch(error => {
						flash("Sorry we could'nt update this job", 'failed');
						this.processing = false;
					})
				}	
			},

		}
	}
</script>