<template>
	<div>
		<a @click="$modal.show('ask-a-question')" class="button is-primary"><strong>ASK A QUESTION</strong></a>
		<modal name="ask-a-question" height="auto">
			<div class="ps-container relative-body">
				<div slot="top-right" class="top-right">
			      <button @click="$modal.hide('ask-a-question')">
			        ❌
			      </button>
			    </div>
			  <div class="field">
				  <label class="label">Name</label>
				  <div class="control">
				    <input class="input" type="text" placeholder="Text input">
				  </div>
				</div>

				<div class="field">
				  <label class="label">Email</label>
				  <div class="control has-icons-left has-icons-right">
				    <input class="input is-danger" type="email" placeholder="Email input" value="hello@">
				    <span class="icon is-small is-left">
				      <i class="fas fa-envelope"></i>
				    </span>
				    <span class="icon is-small is-right">
				      <i class="fas fa-exclamation-triangle"></i>
				    </span>
				  </div>
				  <!-- <p class="help is-danger">This email is invalid</p> -->
				</div>

				<div class="field">
				  <label class="label">Subject</label>
				  <div class="control">
				    <div class="select">
				      <select>
				        <option>Select dropdown</option>
				        <option>General</option>
				        <option>Jamb</option>
				        <option>Neco</option>
				        <option>Waec</option>
				        <option>Nabteb</option>
				        <option>Other</option>
				      </select>
				    </div>
				  <p class="help is-danger">To ensure you get quick reply please pick appropriate subject</p>

				  </div>
				</div>

				<div class="field">
				  <label class="label">Ask Questions Here</label>
				  <div class="control">
				    <textarea class="textarea" placeholder="Textarea"></textarea>
				  </div>
				</div>

				<div class="field">
				  <div class="control">
				    <label class="checkbox">
				      <input type="checkbox">
				      I agree to the <a href="#">terms and conditions</a>
				    </label>
				  </div>
				</div>

				<div class="field is-grouped">
				  <div class="control">
				    <button class="button is-link">Submit</button>
				  </div>
				  <div class="control">
				    <button class="button is-link is-light" @click="$modal.hide('ask-a-question')">Cancel</button>
				  </div>
				</div>
			</div>
		</modal>
	</div>
        
        	
</template>

<script>
	
</script>

<style scoped>
	.ps-container {
		padding: 1.5em;
	}

	.top-right {
		position: absolute;
	    top: 5px;
	    right: 5px;
	}
</style>