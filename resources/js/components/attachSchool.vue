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
					      <select v-model="sort" @change="changeType">
					        <option value="" selected>Sort</option>
					        <option v-for="type in types" v-text="type.name" :value="type.id"></option>
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
						<school v-for="(school, index) in notAttachedSchools" :key="index" 
							:school="school" 
							:course="course" 
							:check="true">
								
						</school>
						  <infinite-loading @infinite="infiniteHandler"></infinite-loading>
					</tab>
					<tab name="attached">
						<school v-for="(school, index) in attachedSchools" 
							:key="index" 
							:course="course" 
							:school="school" 
							:check="false">
						</school>

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
				types: [],
				sort: '',
				searchKey: '',
				infiniteId: +new Date(),
			}
		},

		methods: {
		    infiniteHandler($state) {
		      axios.get('/courses/getschools', {
		        params: {
		          page: this.page,
		          notattached: this.course.id,
		          type: this.sort,
		          // s: this.searchKey,
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
		          type: this.sort,
		          // s: this.searchKey,
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
		      this.attachedpage = 1;
		      this.notAttachedSchools = [];
		      this.attachedSchools = [];
		      this.infiniteId += 1;
		      this.infiniteHandler();
		      this.getAttached();
		    },
		  },
		created () {
			axios.get('/createSchoolRequirements/')
    		.then (data => {
    			this.types = data.data.Types;
			});
			
		}
	}
</script>