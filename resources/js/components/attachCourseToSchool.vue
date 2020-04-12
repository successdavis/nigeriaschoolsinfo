<template>
	<div> 
		<button @click="$modal.show('attach-courses')" class="button">Attach Courses</button>
		<modal
			name="attach-courses"
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
					        <option value="" selected>Sort By (All)</option>
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
				    <span style="cursor: pointer" @click="selectall">Select All</span>
				  </div>
				</div>
				<tabs>
					<tab name="Not Attached" :selected="true">
						<course v-for="(course, index) in notAttachedCourses" :key="index" 
							:school="school" 
							:course="course" 
							:check="true">
						</course>

						<infinite-loading @infinite="infiniteHandler"></infinite-loading>
					</tab>
					<tab name="attached">
						<course v-for="(course, index) in attachedCourses" 
							:key="index" 
							:course="course" 
							:school="school" 
							:check="false">
						</course>

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
			school: {
				required: true
			},
		},
		data() {
			return {
				attached: [],
				notAttachedCourses: [],
				attachedCourses: [],
				page: 1,
				attachedpage: 1,
				types: [],
				sort: '',
				searchKey: '',
				infiniteId: +new Date(),
				selectallitems: [],
			}
		},

		methods: {
			selectall() {
				this.notAttachedCourses.forEach(school => {
					this.selectallitems.push(school.id);
				})

				this.attachMany();
			},
			attachMany(){
				axios.post(`\\api/schoolcourseattachmany/${this.course.slug}`, {
					schools: this.selectallitems
				})
	    		.then (data => {
                    flash('Batch Schools Create.', 'success');
                    this.resetnotattached();
				})
				.catch(error => {
                    flash('Unable to attach Many, Please contact Admin.', 'failed');
				});
			},

			// This method retrieve all the courses that are not attached to a school
		    infiniteHandler($state) {
		      axios.get(`/coursesnotattached/${this.school.slug}`, {
		        params: {
		          page: this.page,
		          type: this.sort,
		        },
		      }).then(({ data }) => {
		        if (data.data.length) {
		          this.page += 1;
		          this.notAttachedCourses.push(...data.data);
		          $state.loaded();
		        } else {
		          $state.complete();
		        }
		      });
		    },

		    getAttached($state) {
		      axios.get(`/coursesattached/${this.school.slug}`, {
		        params: {
		          page: this.attachedpage,
		          type: this.sort,
		          // s: this.searchKey,
		        },
		      }).then(({ data }) => {
		        if (data.data.length) {
		          this.attachedpage += 1;
		          this.attachedCourses.push(...data.data);
		          $state.loaded();
		        } else {
		          $state.complete();
		        }
		      });
		    },

		    changeType() {
		      this.resetnotattached();
		      this.attachedpage = 1;
		      this.attachedCourses = [];
		      this.infiniteId += 1;
		      this.getAttached();
		    },

		    resetnotattached() {
		     	this.page = 1;
		      	this.notAttachedCourses = [];
		      	this.infiniteId += 1;
		      	this.infiniteHandler();
                this.selectallitems = [];
		    }
		  },
		created () {
			axios.get('/createSchoolRequirements/')
    		.then (data => {
    			this.types = data.data.Types;
			});
			
		}
	};
</script>