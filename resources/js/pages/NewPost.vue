<script>
  	import Editor from '../components/editor';
	import ImageUpload from '../components/ImageUpload';
	export default {
	    components: {
	      Editor,
	      ImageUpload
	    },
	    props: ['post','image'],
		data () {
			return {
                featuredimage: this.image,
				posthandle: this.post,
				schooltypes: '',
				type: '',
				schools: '',
				courses: '',
				categories: '',
				jobs: '',
				exams: '', 
				disabled: false,
				PostForm: new Form({
					body: this.post != null ? this.post.body : '',
					title: this.post != null ? this.post.title : '',
					meta_description: this.post != null ? this.post.meta_description : '',
					module: this.module != null ? this.module : '',
					module_id: this.post != null ? this.post.source_id : ''
				}),
			}
		},

		computed: {
			meta_length () {
				let char = this.PostForm.meta_description.length,
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

                axios.post(`/posts/${this.posthandle.slug}/featured_image`, data)
                    .then(() => flash('Post Cover Image Uploaded! '))
                    .catch(() => flash('Cover Image Upload Failed','failed'));
            },
			setPostBody (value) {
				this.PostForm.body = value;
			},

			publishPost () {

				this.disabled = true;
				if (!this.posthandle) {
					this.PostForm.post('/posts/publishpost')
					.then(data => {
						flash('Your new post has been published', 'success')
						this.posthandle = data;
						this.disabled = false;
					})
					.catch(error => {
						flash('Your Form Has errors', 'failed')
						this.disabled = false;
					});
				}else {
					this.PostForm.patch(`/posts/updatepost/${this.posthandle.slug}`)
					.then(data => {
						flash('Post Updated', 'success')
						this.disabled = false;
					})
					.catch(error => {
						flash('Update Failed', 'failed');
						this.disabled = false;
					})
				}
			},

			getSchools () {
				this.schools = [];
				axios.get(`/api/schools/${this.type}`)
				.then (data => {
					this.schools = data.data;
				})
			},

			resetField() {
				this.PostForm.module_id = '';
			}
		},

		created () {
			axios.get('/posts/newpostrequirements')
	    		.then (data => {
	    			this.exams = data.data.exams;
	    			this.courses = data.data.courses;
	    			this.schooltypes = data.data.schooltype;
			});
			axios.get('/categories')
	    		.then (data => {
	    			this.categories = data.data;
			});
			axios.get('/latest-job-opportunities-and-application')
	    		.then (data => {
	    			this.jobs = data.data.data;
			});
		},
	}
</script>