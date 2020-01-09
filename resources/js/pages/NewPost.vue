<script>
	export default {
		data () {
			return {
				posthandle: '',
				schooltypes: '',
				type: '',
				schools: '',
				courses: '',
				exams: '', 
				PostForm: new Form({
					body: '',
					title: '',
					module: '',
					module_id: ''
				}),
			}
		},

		methods: {
			publishPost () {
				if (this.posthandle) {
					this.PostForm.post('/posts/publishpost')
					.then(data => {
						flash('Your new post has been published', 'success')
						this.posthandle = data;
					})
					.catch(error => {
						flash('Your Form Has errors', 'failed')
					});
				}else {
					this.PostForm.update('/posts/updatepost')
					.then(data => {
						console.log(data);
						this.posthandle = data;
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
		},
	}
</script>