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
			<b-switch @input="setDate" v-model="admitting"></b-switch>
		</td>

	    <modal 
	    	:name="school.name"
			height="auto" 
			:adaptive="true"
			scrollable="scrollable"
			class="section"
	    >
	    	<div class="section" style="padding-bottom: 25em;">
		    	<template>
				    <b-field label="When will the reg. end?">
				        <b-datepicker
				            placeholder="Click to set..."
				            :min-date="minDate"
				            :max-date="maxDate"
				            v-model="ends_at"
				        ></b-datepicker>
				    </b-field>
				</template>

				<button class="button is-primary" @click="toggleAdmit">Set End Date</button>
	    	</div>
	    	
	    </modal>

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
		const today = new Date()
		return {
			admitting: this.school.admitting,
			ends_at: '',
            minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
            maxDate: new Date(today.getFullYear() + 18, today.getMonth(), today.getDate())
		}
	},

	methods: {
		setDate(value) {
			value ? this.$modal.show(this.school.name) : this.toggleAdmit(value);
		},

		toggleAdmit(value) {
			axios[this.admitting ? 'patch' : 'delete'](`/schools/${this.school.slug}/admission`, {
				ends_at: this.ends_at
			})
			.then(() => {
				this.$modal.hide(this.school.name);
			})
			.catch (() => {

			})
		},
	}
}
</script>