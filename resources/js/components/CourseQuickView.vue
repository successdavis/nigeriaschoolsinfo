<template>
	<div>
		<span @click="$modal.show(name)">Quick View</span>
		<modal
			:name="name"
			height="auto"
			:adaptive="adaptive"
			:pivotY="1"
			scrollable="scrollable"
		>

			<div class="section">
				<h3 class="is-size-5 has-text-centered mb-small">Viewing {{course.name}}</h3>
				<h3 class="is-size-5" >Jamb Subjects</h3>
					<table class="table">
					  <thead>
					    <tr>
					      <th><abbr title="Position">Subject</abbr></th>
					      <th>Required</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr v-for="subject in course.subjects">
					      <td v-text="subject.name"></td>
					      <td v-text="subject.required"></td>
					    </tr>
					  </tbody>
					</table>

				<h3 class="is-size-5 has-text-centered">Schools offering <span v-text="course.name"></span></h3>

				<table class="table">
				  <thead>
				    <tr>
				      <th><abbr title="Position">Name</abbr></th>
				      <th>Jamb_Points</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr v-for="school in course.schools">
				      <td v-text="school.name"></td>
				      <td v-text="school.jamb_points"></td>
				    </tr>
				  </tbody>
				</table>
				<div @click="$modal.hide(name)" class="back_to_course"><i class="fas fa-long-arrow-alt-left"></i> Back to Courses</div>
			</div>
			
		</modal>
	</div>
	
</template>

<script>
	export default {
		props: ['name','course'],
		data () {
			return {
				scrollable: true,
				adaptive: true,
			}
		},

		mounted() {
		    this.$nextTick(() => {
		      window.addEventListener('resize', this.onResize);
		    })
	  	},
	}
</script>

<style scoped>
.back_to_course {
	position: fixed;
    bottom: 0;
    width: 100%;
    padding: 1em 1.3em;
    background: cyan;
    left: 0;
}
</style>