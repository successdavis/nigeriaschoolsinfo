<template>
	<div> 
		<button @click="$modal.show('attach-school')" class="button">Modify Course</button>
		<modal
			name="attach-school"
			height="auto"
			:adaptive="true"
			scrollable="scrollable"
		>
			<div class="section">
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
				<tabs>
					<tab name="Not Attached" :selected="true">
						<school v-for="(school, index) in notAttachedSchools" :key="index" :school="school" :course="course" tagged="Attach"></school>
						  <infinite-loading @infinite="infiniteHandler"></infinite-loading>
					</tab>
					<tab name="attached">
						<school v-for="(school, index) in attachedSchools" :key="index" :course="course" :school="school" tagged="Unlink"></school>
						  <infinite-loading @infinite="getAttached"></infinite-loading>
					</tab>
				</tabs>
			</div>
		</modal>
	</div>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
	export default {
		 components: {
		    InfiniteLoading,
		  },
		props: {
			course: {
				required: true
			},
		},
		data() {
			return {
				attached: [],
				notAttachedSchools: [],
				attachedSchools: [],
				page: 1,
				attachedpage: 1,
				type: '',
				infiniteId: +new Date(),
			}
		},

		methods: {
		    infiniteHandler($state) {
		      axios.get('/courses/getschools', {
		        params: {
		          page: this.page,
		          notattached: this.course.id,
		        },
		      }).then(({ data }) => {
		        if (data.data.length) {
		          this.page += 1;
		          this.notAttachedSchools.push(...data.data);
		          $state.loaded();
		        } else {
		          $state.complete();
		        }
		      });
		    },
		    getAttached($state) {
		      axios.get('/courses/getschools', {
		        params: {
		          page: this.attachedpage,
		          attached: this.course.id,
		        },
		      }).then(({ data }) => {
		        if (data.data.length) {
		          this.attachedpage += 1;
		          this.attachedSchools.push(...data.data);
		          $state.loaded();
		        } else {
		          $state.complete();
		        }
		      });
		    },
		    changeType() {
		      this.page = 1;
		      this.notAttachedSchools = [];
		      this.infiniteId += 1;
		    },
		  },
		created () {
			// axios.get(`/courses/getschools`, {params: {attached: this.course.id},})
   //  		.then (data => {
   //  			this.attachedSchools = data.data.data;
			// });
			// axios.get(`/courses/getschools`, {params: {notattached: this.course.id},})
   //  		.then (data => {
   //  			this.notAttachedSchools = data.data.data;
			// });
		}
	}
</script>