	export default {
		props: {
			school: {required: true},
			check: {default: false},
			course: {required: false},
		},

		data () {
			return {
				showChecked: this.check,
			}
		},

		methods: {
			attachItems()
			{
				axios.post(`\\api/schoolcourseattachment`, {
					course: this.course.id,
					school: this.school.id
				}).then(data => {
					this.showChecked = false;
				})
				.catch(error => {
                    flash('There was a problem linking this school', 'failed');
                });
			},
			detachedItems()
			{
				axios.delete(`\\api/schoolcoursedetachment`, {
					params: {
						course: this.course.id,
						school: this.school.id
					}
				}).then(data => {
					this.showChecked = true;
				})
				.catch(error => {
                    flash('There was a problem linking this school', 'failed');
                });
			},
		}
	}