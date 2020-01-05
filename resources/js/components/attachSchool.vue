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
			<div class="section">
				<tabs>
					<tab name="Not Attached" :selected="true">
						<div class="columns">
						  <div class="column is-3">
						    <div class="field">
							  <div class="control ">
							    <div class="select is-small">
							      <select>
							        <option value="" selected>Types</option>
							        <option>With options</option>
							      </select>
							    </div>
							  </div>
							</div>
						  </div>
						  <div class="column">
						    <input class="input is-rounded" type="text" placeholder="Rounded input">
						  </div>
						  <div class="column is-2">
						    <span style="cursor: pointer">Select All</span>
						  </div>
						</div>
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
		props: {
			course: {
				required: true
			},
		},
		data() {
			return {
				notAttachedSchools: [],
				attachedSchools: [],
			}
		},

		created () {
			// '/courses/getschools/' . $this->course->slug . '?selected=attached'
			axios.get(`/courses/getschools/${this.course.slug}?selected=attached`)
    		.then (data => {
    			this.attachedSchools = data.data;
			});
		}
	}
</script>