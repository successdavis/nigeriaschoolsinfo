<script>
  import Editor from '../components/editor';
	export default {
		components: {
	      Editor
	    },
	    props: {
	    	project: {
	    		default: null,
	    	}
	    },
		data () {
			return {
				faculties: [],
				faculty_id: '',
				educationlevels: [],
				courses: [],
				posthandle: this.project,
				processing: false,
				PostForm: new Form({
					title: this.project != null ? this.project.title : '',
					description: this.project != null ? this.project.description : '',
					course_id: this.project != null ? this.project.course_id :'',
					schooltype_id: this.project != null ? this.project.schooltype_id : '',
					amount: this.project != null ? this.project.amount : '',
				}),
			}
		},

		mounted() {
				axios.get(`/getfaculties`)
				.then (data => {
					this.faculties = data.data;
				}),
				axios.get(`/educationlevels`)
				.then (data => {
					this.educationlevels = data.data;
				})
			},

		methods: {
			persistFile() {
		        if(! this.$refs.file.files[0]) return;
		        let file = this.$refs.file.files[0];

		        let data = new FormData();

		        data.append('file', file);
		        axios.post(`/projects/${this.posthandle.slug}/uploadmaterial`, data)
		            .then(data => {
		                flash('File Uploaded!');
		            })
		            .catch(error => {
		            	flash('Unable to upload this project. Make sure its in the right format', 'failed');
		            });
		    },

			setPostBody (value) {
				this.PostForm.description = value;
			},
			publishPost(){
				if (!this.posthandle) {
					this.PostForm.post('projects/newproject')
					.then(data => {
						flash('Your new project has been created', 'success')
						this.posthandle = data;
						this.processing = false;
					})
					.catch(error => {
						flash('Something went wrong submitting your data', 'failed')
						this.processing = false;
					});
				}else {
					this.PostForm.patch(`/project/${this.posthandle.slug}/update`)
					.then(data => {
						flash('Project Updated', 'success')
						this.processing = false;
					})
					.catch(error => {
						flash("Sorry we could'nt update this project", 'failed');
						this.processing = false;
					})
				}	
			},

			getCourses() {
				axios.get(`/courses?faculty=${this.faculty_id}`)
				.then (data => {
					this.courses = data.data.data;
				})
			}
		}
	}	
</script>