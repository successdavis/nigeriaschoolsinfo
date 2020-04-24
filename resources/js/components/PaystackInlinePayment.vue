<template>
	<div>
		<form @submit.prevent="initialize">
		  <button 
			  class="button"
			  :class="processing ? 'loading' : ''" 
			  type="button" 
			  @click="initialize" 
			  v-text="button ? button : 'Purchase'">
		  </button> 
		</form>
	</div>
</template>
<script>
	export default {
		props: ['id','type','description','button','email'],
		data() {
			return {
				success: false,
				processing: false,
				billable_type: this.type,
				billable_id: this.id,
				transaction_ref: '',
				amount: '',
			}
		},
		
		methods: {
			initialize() {
				this.processing = true;
				axios.post('/initializepayment',{
					module: this.billable_type,
					id: this.billable_id,
					description: this.description,
				})
				.then (data => {
					console.log(data.data);
					this.amount = data.data.amount,
					this.transaction_ref = data.data.transaction_ref
					this.processing = false;
					this.payWithPaystack();
				})
			},
			payWithPaystack(){
			    var handler = PaystackPop.setup({
			      key: 'pk_test_28408f469c8cab977b6440f21cfc4e171beefc00',
			      email: this.email,
			      amount: this.amount,
			      currency: "NGN",
			      ref: this.transaction_ref,
			      metadata: {
			         custom_fields: [
			            {
			                secret: "Dummy Text",
			            }
			         ]
			      },
			      callback: function(response){
			        flash('Thank you for choosing NSIS, We are verifying your payment');
			      	axios.post('/payment/'+response.reference)
			      	.then(data => {
			      		console.log(data);
				        flash('Payment Verified Successfully');
			      		this.success = true;
			      	})
			      	.catch(error => {
			      		console.log(error)
			      		flash("Sorry! we couldn't verify this payment",'failed')
			      	})
			      },
			      onClose: function(){
			          alert('Sure about this?');
			      }
			    });
			    handler.openIframe();
			},
			completePayment(response) {
				console.log(response);
				console.log('=============');
				console.log(this.transaction_ref);

				// axios.post('/payment/' + this.transaction_ref,{
		  //     		data: response
		  //     	}).then ({

		      	// });
			}
		}
	}
</script>