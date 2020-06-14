	export default {
		props: {
			school: {required: true},
			course: {required: false},
		},

		data () {
			return {
				ismulticheck: false,
				showChecked: this.course.is_link,
				cutoffpoints: '',
			}
		},

		methods: {
			attachItem()
			{
				axios.post(`\\api/schoolcourseattachment`, {
					course: this.course.id,
					school: this.school.id,
					cut_off_points: this.cutoffpoints
				}).then(data => {
					this.$emit('linked');
					this.cutoffpoints = '';
				})
				.catch(error => {
                    flash('Course linking failed. Be sure to provide jamb points', 'failed');
                });
			},
			detachItem()
			{
				axios.delete(`\\api/schoolcoursedetachment`, {
					params: {
						course: this.course.id,
						school: this.school.id
					}
				}).then(data => {
					this.$emit('unlinked');
				})
				.catch(error => {
                    flash('There was a problem linking this school', 'failed');
                });
			},
		}
	}