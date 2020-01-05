<template>
	<div> 
		<button @click="$modal.show('attach-school')" class="button">Modify Course</button>
		<modal
			name="attach-school"
			height="auto"
			:adaptive="true"
			scrollable="scrollable"
		>
			<!-- <div class="section"> 	
				<button class="button">Edit Course</button>
				<button class="button">Add Requirement</button>
				<button class="button">Add or Remove Schools</button>
			</div> -->
			<div>
				<tabs>
					<tab name="Not Attached" :selected="true">
						<p>some dummy text</p>
					</tab>
					<tab name="attached">
						<p>some other dummy text here</p>
					</tab>
				</tabs>
			</div>
		</modal>
	</div>
</template>

<script>
	export default {
		props: ['course'],
		data() {
			return {
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