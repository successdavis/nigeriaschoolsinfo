@extends('layouts.app')

@section('title')
    Create a new Project
@endsection

@section('head')
    <meta name="description" content="Do you have a project at hand you will like to sell out? If yes, then sell to us. Click here now to submit your project for review">
  	<meta name="keywords" content="sell your project"> 
@endsection

@section('content')
	<div class="container">
		<div class="section">
			<project-material
			@isset ($project)
			 :project="{{$project}}" 
			@endisset
			 inline-template>
				 <div>
					<form @submit.prevent="publishPost">
						<div class="field">
						  <label class="label">Project Title</label>
						  <div class="control">
						    <input v-model="PostForm.title" class="input" type="text" placeholder="What is the title of your project">
						  </div>
						  <p class="help is-danger" v-if="PostForm.errors.has('title')" v-text="PostForm.errors.get('title')">
						</div>

						<div class="field">
						  <label class="label">Faculty</label>
						  <div class="control">
						    <div class="select">
						      <select @change="getCourses" v-model="faculty_id">
						        <option value="">Faculties</option>
						        <option v-for="faculty in faculties" :value="faculty.slug" v-text="faculty.name"></option>
						      </select>
						    </div>
						  </div>
						</div>

						<div class="field" >
						  <label class="label">Course</label>
						  <div class="control">
						    <div class="select">
						      <select v-model="PostForm.course_id">
						        <option value="">Pick a Course</option>
						        <option v-for="course in courses" v-text="course.name" :value="course.id"></option>
						      </select>
						    </div>
							<p class="help is-danger" v-if="PostForm.errors.has('course_id')" v-text="PostForm.errors.get('course_id')">
						  </div>
						</div>

						<div class="field" >
						  <label class="label">Education Level</label>
						  <div class="control">
						    <div class="select">
						      <select v-model="PostForm.schooltype_id">
						        <option value="">Pick Level</option>
						        <option v-for="level in educationlevels" v-text="level.name" :value="level.id"></option>
						      </select>
						    </div>
							<p class="help is-danger" v-if="PostForm.errors.has('schooltype_id')" v-text="PostForm.errors.get('schooltype_id')">
						  </div>
						</div>
						<p>The description should contain the Abstract, Introduction and Table of Contents only, take advantage of the editor tools to format your content properly</p>
						<div class="field">
						  <label class="label">Project Description</label>
						  <div class="control">
						  	<editor :value="PostForm.description" @content="setPostBody"></editor>
						  </div>
							<p class="help is-danger" v-if="PostForm.errors.has('description')" v-text="PostForm.errors.get('description')">
						</div>

						<div class="field is-grouped">
						  <div class="control">
						    <button :disabled="processing" :class="processing ? 'is-loading' : '' " type="submit" class="button is-link" v-if="!posthandle">Publish Now</button>
						    <button :disabled="processing" type="submit" :class="processing ? 'is-loading' : '' " class="button is-link" v-if="posthandle">Update Project</button>
						  </div>
						</div>
					</form>
					<div class="section">
						<p class="is-size-4 section">Upload your project material below. only docx files allowed</p>
						<div class="file" v-if="posthandle">
						  <label class="file-label">
						    <input accept=".doc,.docx,application/msword" class="file-input" type="file" id="file" ref="file" @change="persistFile">
						    <span class="file-cta">
						      <span class="file-icon">
						        <i class="fas fa-upload"></i>
						      </span>
						      <span class="file-label">
						        Choose a file…
						      </span>
						    </span>
						  </label>
						</div>
					</div>
				</div>
			</project-material>
		</div>
	</div>
	
	
@endsection