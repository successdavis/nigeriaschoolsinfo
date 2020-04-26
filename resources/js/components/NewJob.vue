<script>
  	import Editor from '../components/editor';
	import ImageUpload from '../components/ImageUpload';
	export default {
		components: {
	      Editor,
	      ImageUpload
	    },
	    props: ['job','image'],
		data () {
			return {
                featuredimage: this.image,
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
					meta_description:this.job != null ? this.job.meta_description : '',

				}),
			}
		},

		computed: {
			meta_length () {
				let char = this.postData.meta_description.length,
	            limit = 150;
	        	return (limit - char);
			}
		},

		methods: {
			onLoad(image) {
	            this.featuredimage = image.src;

	            this.persist(image.file);
	        },
	        persist(file) {
                let data = new FormData();

                data.append('file', file);

                console.log(data);

                axios.post(`/jobs/${this.jobhandler.slug}/featured_image`, data)
                    .then(() => flash('Job Cover Image Uploaded! '))
                    .catch(() => flash('Job Cover Upload Failed','failed'));
            },
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
						this.processing = false;
						flash('Something went wrong submitting your data', 'failed')
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