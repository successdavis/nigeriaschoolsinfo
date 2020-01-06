<template>
	<article class="media">
	  <figure class="media-left">
	    <p class="image is-32x32">
	      <img :src="school.logo_path">
	    </p>
	  </figure>
	  <div class="media-content">
	    <div class="content"v-text="school.name">
	    	
	    </div>
	  </div>
	  <div class="media-right">
	    <div class="is-danger">
	    	<span class="icon has-text-warning">
		  		<i class="fas fa-check" v-if="showChecked"></i>
			</span>
			<span class="icon has-text-warning" v-if="! showChecked">
		  		<i class="fas fa-exclamation-triangle"></i>
			</span>
			<span style="cursor: pointer" v-if="showChecked" @click="attachSchool">Attach</span>
			<span style="cursor: pointer" v-if="!showChecked" @click="detachedSchool">Detached</span>
		</div>
	  </div>
	</article>
</template>

<script>
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
			attachSchool()
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
			detachedSchool()
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
</script>