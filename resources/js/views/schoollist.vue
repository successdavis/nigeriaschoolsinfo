<template>
	<tr>
		<td class="has-no-head-mobile is-image-cell">

		</td>
		<td data-label="Name" class="">
			<a :href="school.slug" v-text="school.name"></a>
		</td>
		<td data-label="Short Name" v-text="school.short_name" class=""></td>
		<td data-label="Website" v-text="school.website" class=""></td>
		<td data-label="Admitting" class="">
			<b-switch @input="toggleAdmit" v-model="admitting"></b-switch>
		</td>
		<td data-label="Level" v-text="school.level" class=""></td>
		<td data-label="Sponsor" v-text="school.sponsor" class=""></td>
		<td data-label="Visits" class=""> 
			<small title="Sep 19, 2018" class="has-text-grey is-abbr-like"
			v-text="school.visits"></small>
		</td>
		<td class="is-actions-cell">
			<div class="buttons are-small is-right">
				<button type="button" class="button is-danger" @click="deleteSchool(school.slug, index)">
					<span class="icon is-small" title="Delete Post">
						<i class="mdi mdi-trash-can"></i>
					</span>
				</button>
				<button type="button" :class="school.followup ? 'is-success' : '' " class="button" @click="togglelink(school.slug, index)">
					<span class="icon is-small" >
						<i v-if="school.followup" title="Turn off Admitting" class="mdi mdi-link-off"></i>
						<i v-else class="mdi mdi-link" title="Turn on Admitting"></i>
					</span>
				</button>
				<!-- Router button that leads to edit post -->
				<router-link :to="{name: 'editschool', params: {slug: school.slug}}">
					<button type="button" class="button">
						<span class="icon is-small" title="Edit Post">
							<i class="mdi mdi-pencil"></i>
						</span>
					</button>
				</router-link>
			</div>
		</td>
	</tr>
</template>

<script>
export default {
	props: ['school'],
	data () {
		return {
			admitting: this.school.admitting,
		}
	},

	methods: {
		toggleAdmit(value) {
			axios[this.admitting ? 'patch' : 'delete'](`/schools/${this.school.slug}/admission`)
			.then(() => {

			})
			.catch (() => {

			})
		},
	}
}
</script>