<template>
     <div class="card has-table has-mobile-sort-spaced">
    	<v-dialog />

		<header class="card-header card-cen-v">
			<p class="card-header-title">
				<span class="icon"><i class="fas fa-users"></i></span>
				<span>ALL COURSES</span>
			</p>
			<button type="button" class="button is-small align-sf-ct">
				<span class="icon"><i class="mdi mdi-refresh default"></i></span>
				<span @click="fetch">Refresh</span>
			</button>
		</header>
		<div class="notification is-card-toolbar">
			<div class="level">
				<div class="level-left">
					<div class="level-item">
						<div class="buttons has-addons">
							<!-- <button :class="all ? 'is-success' : '' " class="button" @click="resetfilters">All</button> -->
							<button class="button"><router-link to="/addcourse">Add New</router-link></button>
						</div>
					</div>
				</div>
				<div class="level-right">
					<div class="level-item">
						<form>
							<div class="field has-addons">
								<div class="control">
									<input @keyup="fetch" v-model="searchKey" type="text" placeholder="Name | Id_No | Email" class="input">
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
												<i class="mdi mdi-arrow-up"></i>
												<i class="mdi mdi-arrow-down"></i>
											</span>
										</div>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(course,index) in courses" :key="course.id">
									<td></td>
									<td ><a :href="course.path" target="_blank">{{course.name}}</a></td>
									<td v-text="course.short_name"></td>
									<td v-text="course.visits"></td>
									<td class="is-actions-cell">
										<div class="buttons are-small is-right">
											<router-link :to="{name: 'editcourse', params: {slug: course.slug}}">
												<button type="button" class="button">
													<span class="icon is-small" title="Edit Course">
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
					<paginator @changed="fetch" :dataset="dataSet"></paginator>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import coursescollection from '../mixins/courses';

	export default {
        mixins: [coursescollection],
        data () {
        	return {
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
                    field: 'visits',
                    label: 'Visits',
                }
            ]
        	}
        },
        methods: {
        	fetch(page) {
				this.isLoading = true;
				axios.get('/courses', {
                    params: {
                        page: page,
                        // column: this.sortedColumn,
                        // order: this.order,
                        // per_page: this.per_page,
                        s: this.searchKey,
                    }
                })
				.then(this.refresh)

			},
        },
	};
</script>