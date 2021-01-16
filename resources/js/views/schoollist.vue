<template>
	<tr>
		<td class="has-no-head-mobile is-image-cell">

		</td>
		<td data-label="Name" class="">
			<a :href="school.path" target="_blank">{{school.name}}</a>
		</td>
		<td data-label="Short Name" v-text="school.short_name"></td>
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
				<router-link :to="{name: 'editschool', params: {slug: school.slug}}">
					<button type="button" class="button">
						<span class="icon is-small" title="Edit School">
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