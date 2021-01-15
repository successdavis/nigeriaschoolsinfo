<template>
     <div class="card has-table has-mobile-sort-spaced">
    	<v-dialog />

		<header class="card-header card-cen-v">
			<p class="card-header-title">
				<span class="icon"><i class="fas fa-users"></i></span>
				<span> SCHOOLS</span>
			</p>
			<button type="button" class="button is-small align-sf-ct">
				<span class="icon"><i class="mdi mdi-refresh default"></i></span>
				<span @click="fetchSchools">Refresh</span>
			</button>
		</header>
		<div class="notification is-card-toolbar">
			<div class="level">
				<div class="level-left">
					<div class="level-item">
						<div class="buttons has-addons">
							<button :class="all ? 'is-success' : '' " class="button" @click="resetfilters">All</button>
							<button class="button"><router-link to="/addschool">Add New</router-link></button>
						</div>
					</div>
				</div>
				<div class="level-right">
					<div class="level-item">
						<form>
							<div class="field has-addons">
								<div class="control">
									<input @keyup="schoolSearch" v-model="searchkeyword" type="text" placeholder="Name | Id_No | Email" class="input">
								</div>
								<div class="control">
									<button type="submit" class="button is-primary" :class="isLoading ? 'is-loading' : '' ">
										<span class="icon"><i class="fas fa-search"></i></span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="card-content">
			<div>
				<div class="b-table">
					<div class="field table-mobile-sort">
						<div class="field has-addons">
							<div class="control is-expanded">
								<span class="select is-fullwidth">
									<select>
										<option v-for="column in columns" value="[object Object]">{{column.label}}</option>
									</select>
								</span>
							</div>
							<div class="control">
								<button class="button is-primary">
									<span class="icon is-small"><i class="fas fa-arrow-up"></i></span>
								</button>
							</div>
						</div>
					</div>
					
					<div class="table-wrapper has-mobile-cards">
						<table class="table is-striped has-mobile-cards is-hoverable">
							<thead>
								<tr>
									<th class="">
										<div class="th-wrap">
											<span class="icon is-small" style="display: none;">
												<i class="mdi mdi-arrow-up"></i>
											</span>
										</div>
									</th>

									<th class="" v-for="column in columns">
										<div class="th-wrap">{{column.label}}
											<span class="icon is-small">
												<i class="mdi mdi-arrow-up" v-if="sortdir == 'dsc'"></i>
												<i class="mdi mdi-arrow-down" v-if="sortdir == 'asc'"></i>
											</span>
										</div>
									</th>
								</tr>
							</thead>
							<tbody>
								<schoollist :school="data" v-for="(data,index) in data" :key="data.id"></schoollist>
							</tbody>
						</table>
					  	<!-- <infinite-loading :identifier="infiniteId" @infinite="fetch"></infinite-loading> -->
		  	            <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="true"></b-loading>
					</div>
					<paginator @changed="fetchSchools" :dataset="dataset"></paginator>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import collection from '../mixins/collection';
    import _ from 'lodash';
	import schoollist from './schoollist.vue';
    export default {
		components: {schoollist},
        data() {
            return {
                data: [
                ],
                error: '',
                columns: [
                    {
                        field: 'name',
                        label: 'Name',
                    },
                    {
                        field: 'short_name',
                        label: 'Short Name',
                    },
                    {
                        field: 'website',
                        label: 'Website',
                        centered: true
                    },
                    {
                        field: 'admitting',
                        label: 'Admitting',
                    },
                    {
                        field: 'schooltype',
                        label: 'Level',
                    },
                    {
                        field: 'sponsored_id',
                        label: 'Sponsor',
                    },
                    {
                        field: 'visits',
                        label: 'Visits',
                    }
                ],
                total: 'not set',
                per_page: '50',
                searchkeyword: '',
                sortby: '',
                isLoading: false,
                sortdir: 'dsc',
                draft: false,
                deleted: false,
                all: true,
                dataset: false,
            }
        },
		beforeRouteEnter (to, from, next) {
	    	
	    	axios.get('/schools')
			.then(({data}) => {
				next(vm => vm.setData(data));
			})
			.catch((error) => {
				flash('Unable to retrieve schools at the moment');
				return false
			})

	    	// axios.get(`editpost/${to.params.slug}`)
    		// .then (data => {
    		// 	next(vm => vm.setData(data.data.data));
    		// })
	  	},

		methods: {
			setData (data) {
		      if (data) {
		      	console.log(data.data)
		        this.data = data.data;
		        this.dataset = {
                    next_page_url : data.links.next,
                    current_page: data.meta.current_page,
                    per_page: data.meta.per_page,
                    total: data.meta.total,
                    from: data.meta.from,
                    last_page: data.meta.last_page,
                    prev_page_url: data.links.prev
                };
		      }
		    },

		    toggleAdmit(data, index) {
		    	console.log('hey')
		    	axios.patch(`schools/${data.slug}/admit`)
		    },

		    resetfilters() {
		    	this.all = true;
		    	this.fetchSchools();
		    },

            schoolSearch: _.debounce(function(page) {
                this.isLoading = true;
                this.fetchSchools();
            }, 600),

			fetchSchools (page) {
				this.isLoading = true;
				axios.get('/schools', {
                    params: {
                        page: page,
                        // column: this.sortedColumn,
                        // order: this.order,
                        // per_page: this.per_page,
                        s: this.searchkeyword,
                    }
                })
				.then(({data}) => {
					this.setData(data);
					this.isLoading = false;
				})
				.catch((error) => {
					this.isLoading = false;
					flash('Unable to retrieve schools at the moment');
				})

			},

			deleteSchool(slug, index) {
				this.$modal.show('dialog', {
				  title: 'Warinig: Delete Attempt',
				  text: 'Sure about this?',
				  buttons: [
				    {
				      title: 'No',
				      handler: () => {
				        this.$modal.hide('dialog')
				      }
				    },
				    {
				      title: 'Yes',
				      handler: () => {
				        axios.delete(`${slug}/delete`)
				        .then(
				        	() => flash('School Deleted'), 
				        	this.$modal.hide('dialog'),
				        	this.data.splice(index, 1)
				        )
				        .catch(() => falsh('unable to delete this school','failed'), this.$modal.hide('dialog'))
				      }
				    }
				  ]
				})
			},
		}
    }
</script>

<style scoped>
	i {
	    font-size: 1.3em;
	}
</style>