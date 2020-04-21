<script>
  import Editor from '../components/editor';
	export default {
		components: {
	      Editor
	    },
	    props: ['scholarship'],
		data () {
			return {
				scholarshiphandler: this.scholarship,
				processing: false,
				postData: new Form({
					title: this.scholarship != null ? this.scholarship.title : '',
					description: this.scholarship != null ? this.scholarship.description : '',
					portal_website: this.scholarship != null ? this.scholarship.portal_website : '',
					phone: this.scholarship != null ? this.scholarship.phone : '',
					location: this.scholarship != null ? this.scholarship.location : '',
					employer:this.scholarship != null ? this.scholarship.employer : '',
					ends_at:this.scholarship != null ? this.scholarship.ends_at : '',

				}),
			}
		},

		methods: {
			setPostBody (value) {
				this.postData.description = value;
			},
			publishscholarship(){
				this.processing = true;
				if (!this.scholarshiphandler) {
					this.postData.post('/scholarships/create')
					.then(data => {
						flash('Your new project has been created', 'success')
						this.scholarshiphandler = data;
						this.processing = false;
					})
					.catch(error => {
						flash('Something went wrong submitting your data', 'failed')
						this.processing = false;
					});
				}else {
					this.postData.patch(`/updatescholarship/${this.scholarshiphandler.slug}`)
					.then(data => {
						flash('Scholarship Updated', 'success')
						this.processing = false;
					})
					.catch(error => {
						flash("Sorry we could'nt update this scholarship", 'failed');
						this.processing = false;
					})
				}	
			},

		}
	}
</script>