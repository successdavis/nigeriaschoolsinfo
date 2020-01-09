@extends('layouts.app')
@section('content')
	<new-post inline-template>
		<div class="container">
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
					        <option value="">Select Post Category</option>
					        <option>Schools</option>
					        <option>Courses</option>
					        <option>Exams</option>
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

					<div class="field">
					  <label class="label">Body</label>
					  <div class="control">
					    <textarea v-model="PostForm.body" class="textarea" placeholder="Start Typing something cool"></textarea>
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
	</new-post>
@endsection