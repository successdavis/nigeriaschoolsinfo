<template>
	<div v-if="!verified">
		Your account is unverified, Click on the link sent to your email address now to verify. <br>
		Or click here to resend link
		<button @click="ResendVerification" class="button is-link" type="submit">Resend Link</button>
        
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="true"></b-loading>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				isLoading: false,
			}
		},
		methods: {
			ResendVerification() {
				this.isLoading = true;
				axios.post('/email/verification-notification')
				.then(() => {
					flash('Link Sent. Please check your email')
					this.isLoading = false;
				})
				.catch(() => {
					flash('Sorry! something went wrong while trying to resend link','failed')
					this.isLoading = false;
				})
			}
		}
	}
</script>