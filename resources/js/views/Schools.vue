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
								<tr class="" v-for="(data,index) in data">
									<td class="has-no-head-mobile is-image-cell">

									</td>
									<td data-label="Name" class="">
										<a :href="data.slug" v-text="data.name"></a>
									</td>
									<td data-label="Short Name" v-text="data.short_name" class=""></td>
									<td data-label="Website" v-text="data.website" class=""></td>
									<td data-label="Admitting" v-text="data.admitting" class="">
										
									</td>
									<td data-label="Level" v-text="data.level" class=""></td>
									<td data-label="Sponsor" v-text="data.sponsor" class=""></td>
									<td data-label="Visits" class="">
										<small title="Sep 19, 2018" class="has-text-grey is-abbr-like"
										v-text="data.visits"></small>
									</td>
									<td class="is-actions-cell">
										<div class="buttons are-small is-right">
											<button type="button" class="button is-danger" @click="deleteSchool(data.slug, index)">
												<span class="icon is-small" title="Delete Post">
													<i class="mdi mdi-trash-can"></i>
												</span>
											</button>
											<button type="button" :class="data.followup ? 'is-success' : '' " class="button" @click="togglelink(data.slug, index)">
												<span class="icon is-small" >
													<i v-if="data.followup" title="Turn off Admitting" class="mdi mdi-link-off"></i>
													<i v-else class="mdi mdi-link" title="Turn on Admitting"></i>
												</span>
											</button>
											<!-- Router button that leads to edit post -->
											<router-link :to="{name: 'editschool', params: {slug: data.slug}}">
												<button type="button" class="button">
													<span class="icon is-small" title="Edit Post">
														<i class="mdi mdi-pencil"></i>
													</span>
												</button>
											</router-link>
										</div>
									</td>
								</tr>
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
    import _ from 'lodash';
    export default {
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