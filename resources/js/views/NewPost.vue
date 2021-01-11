<template>
	<div class="columns">
		<div class="column is-9">
			<form @submit.prevent="savePost">
				<div class="field">
				  <label class="label">Post Title</label>
				  <div class="control">
				    <input v-model="PostForm.title" class="input" type="text" placeholder="Think of a nice title">
				  </div>
		      	<p class="help is-danger" v-if="PostForm.errors.has('title')" v-text="PostForm.errors.get('title')"></p>
				</div>

				<div class="field">
				  <label class="label">Category</label>
				  <div class="control">
				    <div class="select is-fullwidth">
				      <select @change="resetField" v-model="PostForm.module">
				        <option value="">Pick a post type</option>
				        <option>Schools</option>
				        <option>Courses</option>
				        <option>Exams</option>
				        <option>Job</option>
				        <option value="Postcategory">Category Post</option>
				      </select>

				    </div>
		      	<p class="help is-danger" v-if="PostForm.errors.has('module')" v-text="PostForm.errors.get('module')"></p>

				  </div>
				</div>

				<div v-if="PostForm.module == 'Schools'">
					<!-- ============================================================================== -->
					<search @userselected="setSelected" :source_title="source_title" :setup="findschools"></search>
					<!-- ============================================================================== -->
		      	<p class="help is-danger" v-if="PostForm.errors.has('module_id')" v-text="PostForm.errors.get('module_id')"></p>

				</div>

				<div v-if="PostForm.module == 'Exams'">
					<div class="field" >
					  <label class="label">Pick Exams</label>
					  <div class="control">
					    <div class="select is-fullwidth">
					      <select v-model="PostForm.module_id">
					        <option value="">Please select an exams</option>
					        <option v-for="exam in exams" v-text="exam.name" :value="exam.id"></option>
					      </select>
					    </div>
					  </div>
					</div>
		      	<p class="help is-danger" v-if="PostForm.errors.has('module_id')" v-text="PostForm.errors.get('module_id')"></p>

				</div>
				<div v-if="PostForm.module == 'Courses'">
					<search @userselected="setSelected" :source_title="source_title" :setup="findcourses"></search>
		      	<p class="help is-danger" v-if="PostForm.errors.has('module_id')" v-text="PostForm.errors.get('module_id')"></p>

				</div>

				<div v-if="PostForm.module == 'Postcategory'">
					<div class="field" >
					  <label class="label">Pick A Category</label>
					  <div class="control">
					    <div class="select is-fullwidth">
					      <select v-model="PostForm.module_id">
					        <option value="">Please Pick a course</option>
					        <option v-for="category in categories" v-text="category.title" :value="category.id"></option>
					      </select>
					    </div>
					  </div>
					</div>
				</div>
				<div v-if="PostForm.module == 'Job'">
					
					<!-- ============================================================================== -->
					<search @userselected="setSelected" :source_title="source_title" :setup="findjob"></search>
					<!-- ============================================================================== -->
		      	<p class="help is-danger" v-if="PostForm.errors.has('module_id')" v-text="PostForm.errors.get('module_id')"></p>

				</div>

				<div class="field">
				  <label class="label">Body</label>
				  <div class="control">
				  	<editor :value="PostForm.body" @content="setPostBody"></editor>
				  </div>
				</div>

				<div class="field is-grouped">
				  <div class="control">
				    <button :disabled="disabled" @click="publish" type="submit" class="button is-link" v-if="posthandle" v-text="ispublished ? 'Unpublish Post' : 'Publish Post' "></button>
				  </div>
				</div>
			</form>
		</div>
		<div class="column is-3">
			<div class="section">
				<a class="button" @click="savePost">Save</a>
				<h3 class="is-size-4">Featured Image</h3>
				<div v-if="posthandle">
					<img :src="featuredimage">
			        <form method="POST" enctype="multipart/form-data">
			            <image-upload name="file" class="none" @loaded="onLoad"></image-upload>
			        </form>

				</div>
				<p class="help"> Post the content then upload a cover photo here. </p>
				<h3 class="is-size-4 mt-medium">Meta Desc <span v-text="meta_length"></span></h3>
				<textarea maxlength="150" v-model="PostForm.meta_description" class="textarea" placeholder="This content will appear on search result"></textarea>
				<p class="help"> A brief summary of your content. Not less than 140 characters. </p>
		      	<p class="help is-danger" v-if="PostForm.errors.has('meta_description')" v-text="PostForm.errors.get('meta_description')"></p>
			</div>
		</div>
	</div>
</template>
<script>
    import _ from 'lodash';

  	import Editor from '../components/editor';
	import ImageUpload from '../components/ImageUpload';
	import Search from '../components/search';
	export default {
	    components: {
	      Editor,
	      ImageUpload,
	      Search
	    },
		data () {
			return {
				isLoading: false,
                featuredimage: '',
				posthandle: '',
				ispublished: false,
				type: '',
				categories: [],
				jobs: '',
				exams: '', 
				disabled: false,
				PostForm: new Form({
					body: '',
					title: '',
					meta_description: '',
					module: '',
					module_id: ''
				}),
				source_title: '',

				findschools: {
					url: '/schools',
					title: 'name',
					label: 'Enter School Name',
				},

				findcourses: {
					url: '/courses',
					title: 'name',
					label: 'Enter Course Name',
				},
				findjob: {
					url: '/latest-job-opportunities-and-application',
					title: 'title',
					label: 'Enter Job Title',
				}
			}
		},

		computed: {
			meta_length () {
				if (this.PostForm.meta_description) {
					let char = this.PostForm.meta_description.length,
		            limit = 150;
		        	return (limit - char);
				}
			},

			// PostModule() {
			// 	return this.post !=null ? this.post.source_type.split('\\')['1'] : '';
			// }
		},

		methods: {
			onLoad(image) {
	            this.featuredimage = image.src;

	            this.persist(image.file);
	        },
	        persist(file) {
                let data = new FormData();

                data.append('file', file);

                console.log(data);

                axios.post(`/posts/${this.posthandle.slug}/featured_image`, data)
                    .then(() => flash('Post Cover Image Uploaded! '))
                    .catch(() => flash('Cover Image Upload Failed','failed'));
            },
			setPostBody (value) {
				this.PostForm.body = value;
			},

			savePost () {

				this.disabled = true;
				if (!this.posthandle) {
					this.PostForm.post('/posts/savepost')
					.then(data => {
						flash('Your new post has been saved', 'success')
						this.posthandle = data;
						this.disabled = false;
					})
					.catch(error => {
						flash('Sorry, we could not save your new post', 'failed')
						this.disabled = false;
					});
				}else {
					this.PostForm.patch(`/posts/updatepost/${this.posthandle.slug}`)
					.then(data => {
						flash('Post Updated', 'success')
						this.disabled = false;
					})
					.catch(error => {
						flash('Update Failed', 'failed');
						this.disabled = false;
					})
				}
			},

			publish() {
					axios[this.ispublished ? 'delete' : 'patch'](`/posts/${this.posthandle.slug}/togglepublish`)
					.then((data) => {
						this.ispublished = data.data.published
					})
			},

			resetField() {
				this.PostForm.module_id = '';
			},

			setSelected(selected) {
				selected ? this.PostForm.module_id = selected.id : this.PostForm.module_id = '';
			},

			setData(post) {
				if (post) {

					this.posthandle	= post
			        this.PostForm.posthandle = post
			        this.PostForm.body = post.body,
					this.PostForm.title = post.title,
					this.PostForm.meta_description = post.meta_description,
					this.PostForm.module = post.category,
					this.PostForm.module_id = post.source_id
					this.source_title	= post.source_title
					this.featuredimage	= post.image
					this.ispublished	= post.published
			    } else {
			        console.log('failed')
			    }
			}
		},

		created () {
			axios.get('/posts/newpostrequirements')
	    		.then (data => {
	    			this.exams = data.data.exams;
	    			this.courses = data.data.courses;
			});
			axios.get('/categories')
	    		.then (data => {
	    			this.categories = data.data;
			});
			axios.get('/latest-job-opportunities-and-application')
	    		.then (data => {
	    			this.jobs = data.data.data;
			});
		},

	  	beforeRouteEnter (to, from, next) {
	  		if (to.params.slug) {
		    	axios.get(`editpost/${to.params.slug}`)
	    		.then (data => {
	    			next(vm => vm.setData(data.data.data));
	    		})
	  		}else {
		  		next();
	  		}
	  	},

	}
</script>