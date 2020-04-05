<script>
	import TrixVue from '@dymantic/vue-trix-editor';
	export default {
		components: {TrixVue},
		data () {
			return {
				posthandle: '',
				schooltypes: '',
				type: '',
				schools: '',
				courses: '',
				exams: '', 
				disabled: false,
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
		},
	}
</script>