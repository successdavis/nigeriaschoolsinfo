@extends('layouts.app')

@section('title')
    Create/Update a scholarship | Nigeria School Info System
@endsection

@section('head')
    <meta name="description" content="create a new scholarship opportunity, find best and suitable applicants for your scholarship by simply creating a new scholarship here.">
  	<meta name="keywords" content="scholarships, Nigeria scholarships"> 
@endsection

@section('content')
	<div class="container">
		<div class="section">
			<new-scholarship 
				@isset ($scholarship)
				 :scholarship="{{$scholarship}}" 
				@endisset
			inline-template>
				<form @submit.prevent="publishscholarship">

					<div class="field">
					  <label class="label">Scholarship Title</label>
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
					  <label class="label">Location</label>
					  <div class="control">
					    <input v-model="postData.location" class="input" type="text" placeholder="Type it here">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('location')" v-text="postData.errors.get('location')">
					</div>

					<div class="field">
					  <label class="label">Company Name</label>
					  <div class="control">
					    <input v-model="postData.institution" class="input" type="text" placeholder="Type it here">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('institution')" v-text="postData.errors.get('institution')">

					</div>
					<div class="field">
					  <label class="label">Scholarship offer ends at</label>
					  <div class="control">
					    <input v-model="postData.ends_at" class="input" type="date" placeholder="Type it here">
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('ends_at')" v-text="postData.errors.get('ends_at')">

					</div>

					<div class="field">
					  <label class="label">scholarship Description</label>
					  <div class="control">
					  	<editor :value="postData.description" @content="setPostBody"></editor>
					  </div>
					  <p class="help is-danger" v-if="postData.errors.has('description')" v-text="postData.errors.get('description')">

					</div>

					<div class="field is-grouped">
					  <div class="control">
					    <button :class="processing ? 'is-loading':''" type="submit" class="button is-link" v-if="!scholarshiphandler">Publish scholarship</button>
					    <button :class="processing ? 'is-loading':''" type="submit" class="button is-link" v-if="scholarshiphandler">Update scholarship</button>
					  </div>
					</div>
				</form>
			</new-scholarship>
		</div>
	</div>
@endsection