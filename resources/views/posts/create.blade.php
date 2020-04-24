@extends('layouts.app')

@section('title')
	Publish a new blog Article 
@endsection

@section('content')
	<new-post
	@isset ($post)
	 :post="{{$post}}" 
	 image="{{ asset('storage/'.$post->featured_image) }}"
	@endisset
	 inline-template v-cloak>
		<div class="container">
			<div class="columns">
				<div class="column is-9">
					<div class="section">
						<form @submit.prevent="publishPost">
							<div class="field">
							  <label class="label">Post Title</label>
							  <div class="control">
							    <input v-model="PostForm.title" class="input" type="text" placeholder="Please think of a nice title">
							  </div>
							</div>

							<div class="field">
							  <label class="label">Category</label>
							  <div class="control">
							    <div class="select">
							      <select @change="resetField" v-model="PostForm.module">
							        <option value="">Pick a post type</option>
							        <option>Schools</option>
							        <option>Courses</option>
							        <option>Exams</option>
							        <option value="Postcategory">Category Post</option>
							      </select>
							    </div>
							  </div>
							</div>

							<div v-if="PostForm.module == 'Schools'">
								<div class="field" >
								  <label class="label">School Type</label>
								  <div class="control">
								    <div class="select">
								      <select v-model="type" @change="getSchools">
								        <option value="">Pick a School Type</option>
								        <option v-for="type in schooltypes" v-text="type.name" :value="type.slug"></option>
								      </select>
								    </div>
								  </div>
								</div>
								<div class="field" >
								  <label class="label">Select School</label>
								  <div class="control">
								    <div class="select">
								      <select v-model="PostForm.module_id">
								        <option value="">Select School</option>
								        <option v-for="school in schools" v-text="school.name" :value="school.id"></option>
								      </select>
								    </div>
								  </div>
								</div>
							</div>
							<div v-if="PostForm.module == 'Exams'">
								<div class="field" >
								  <label class="label">Pick Exams</label>
								  <div class="control">
								    <div class="select">
								      <select v-model="PostForm.module_id">
								        <option value="">Please select an exams</option>
								        <option v-for="exam in exams" v-text="exam.name" :value="exam.id"></option>
								      </select>
								    </div>
								  </div>
								</div>
							</div>
							<div v-if="PostForm.module == 'Courses'">
								<div class="field" >
								  <label class="label">Pick A Course</label>
								  <div class="control">
								    <div class="select">
								      <select v-model="PostForm.module_id">
								        <option value="">Please Pick a course</option>
								        <option v-for="course in courses" v-text="course.name" :value="course.id"></option>
								      </select>
								    </div>
								  </div>
								</div>
							</div>
							<div v-if="PostForm.module == 'Postcategory'">
								<div class="field" >
								  <label class="label">Pick A Category</label>
								  <div class="control">
								    <div class="select">
								      <select v-model="PostForm.module_id">
								        <option value="">Please Pick a course</option>
								        <option v-for="category in categories" v-text="category.title" :value="category.id"></option>
								      </select>
								    </div>
								  </div>
								</div>
							</div>

							<div class="field">
							  <label class="label">Body</label>
							  <div class="control">
							  	{{-- <input v-model="PostForm.body" id="trix" type="text" name=""> --}}
							  	<editor :value="PostForm.body" @content="setPostBody"></editor>
							  </div>
							</div>

							<div class="field is-grouped">
							  <div class="control">
							    <button :disabled="disabled" type="submit" class="button is-link" v-if="!posthandle">Publish Now</button>
							    <button :disabled="disabled" type="submit" class="button is-link" v-if="posthandle">Update Post</button>
							  </div>
							</div>
						</form>
					</div>
				</div>
				<div class="column is-3">
					<div class="section">
						<h3 class="is-size-4">Featured Image</h3>
						<div v-if="posthandle">
							<img :src="featuredimage">
					        <form method="POST" enctype="multipart/form-data">
					            <image-upload name="file" class="none" @loaded="onLoad"></image-upload>
					        </form>
						</div>
						<h3 class="is-size-4 mt-medium">Meta Description <span>@{{meta_length}}</span></h3>
						<textarea maxlength="150" v-model="PostForm.meta_description" class="textarea" placeholder="This content will appear on search result"></textarea>
				      	<p class="help is-danger" v-if="PostForm.errors.has('meta_description')" v-text="PostForm.errors.get('meta_description')">
					</div>
				</div>
			</div>
		</div>
	</new-post>

	
@endsection