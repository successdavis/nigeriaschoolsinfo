<template>
	<div> 
		<button @click="$modal.show('attach-school')" class="button">Modify Course</button>
		<modal
			name="attach-school"
			height="auto"
			:adaptive="adaptive"
			scrollable="scrollable"
		>
			<div class="section">
				<button class="button">Edit Course</button>
				<button class="button">Add or Remove Schools</button>
			</div>
			<div v-show="transaction = attaching">
				<div></div>
			</div>
		</modal>
	</div>
</template>

<script>
	export default {
		props: ['course'],
		data() {
			return {
				adaptive: true,
				schools: [],
			}
		},

		// created () {
		// 	axios.get('/getSchools')
  //   		.then (data => {
  //   			this.faculties = data.data;
		// 	});
		// }
	}
</script>