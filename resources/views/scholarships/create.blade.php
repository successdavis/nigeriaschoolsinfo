@extends('layouts.app')

@section('title')
    Create/Update a new job | Nigeria School Info System
@endsection

@section('head')
    <meta name="description" content="create a new job opportunity, find best and suitable applicants for your job by simply creating a new job here.">
  	<meta name="keywords" content="jobs, Nigeria jobs"> 
@endsection

@section('content')
	<div class="container">
		<div class="section">
			<new-job 
				@isset ($job)
				 :job="{{$job}}" 
				@endisset
			inline-template>
				<form @submit.prevent="publishJob">

					<div class="field">
					  <label class="label">Job Title</label>
					  <div class="control">
					    <input v-model="postData.title" class="input" type="text" placeholder="Think of a nice title. ">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('title')" v-text="postData.errors.get('title')">
					</div>
					<div class="field">
					  <label class="label">Do you have a website to recieve applications?</label>
					  <div class="control">
					    <input v-model="postData.portal_website" class="input" type="text" placeholder="Type it here">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('portal_website')" v-text="postData.errors.get('portal_website')">

					</div>
					<div class="field">
					  <label class="label">Phone (optional)</label>
					  <div class="control">
					    <input v-model="postData.phone" class="input" type="text" placeholder="Type it here">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('phone')" v-text="postData.errors.get('phone')">

					</div>
					<div class="field">
					  <label class="label">Location</label>
					  <div class="control">
					    <input v-model="postData.location" class="input" type="text" placeholder="Type it here">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('location')" v-text="postData.errors.get('location')">

					</div>
					<div class="field">
					  <label class="label">Company Name</label>
					  <div class="control">
					    <input v-model="postData.employer" class="input" type="text" placeholder="Type it here">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('employer')" v-text="postData.errors.get('employer')">

					</div>
					<div class="field">
					  <label class="label">Job offer ends at</label>
					  <div class="control">
					    <input v-model="postData.ends_at" class="input" type="date" placeholder="Type it here">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('ends_at')" v-text="postData.errors.get('ends_at')">

					</div>

					<div class="field">
					  <label class="label">Job Description</label>
					  <div class="control">
					  	<editor :value="postData.description" @content="setPostBody"></editor>
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('description')" v-text="postData.errors.get('description')">

					</div>

					<div class="field is-grouped">
					  <div class="control">
					    <button :class="processing ? 'is-loading':''" type="submit" class="button is-link" v-if="!jobhandler">Publish Job</button>
					    <button :class="processing ? 'is-loading':''" type="submit" class="button is-link" v-if="jobhandler">Update Job</button>
					  </div>
					</div>
				</form>
			</new-job>
		</div>
	</div>
@endsection