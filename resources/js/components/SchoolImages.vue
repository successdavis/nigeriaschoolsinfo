<template>
	<div>
		<div class="section">		
			<figure class="image is-128x128">
			  <img :src="logo">
			</figure>
		    <form method="POST" enctype="multipart/form-data">
		        <image-upload name="file" class="none" @loaded="onLoad"></image-upload>
		    </form>
		</div>
		<div class="section">
			<h3 class="is-size-3">Add photos to school</h3>
			<p>Your photos should be relevant to people searching this school, an example is the school's front view, back view, lecture rooms, lab etc.</p>
			<p>
				Maximum photos allowed: 5 <br>
				Maximum size allowed: 500kb <br>
				Photos format: jpg, jpeg, png
			</p>
			<div class="section">
				<form @submit.prevent="addPhoto" method="POST" enctype="multipart/form-data">
					<div class="field is-horizontal">
					  	<div class="field-label is-normal">
					    	<label class="label">*Caption</label>
					  	</div>
					  	<div class="field-body">
					    	<div class="field">
					      		<div class="control">
					        		<input v-model="photosForm.caption" required class="input" type="text">
					      		</div>
					      		<p class="help is-danger" v-if="photosForm.errors.has('caption')" v-text="photosForm.errors.get('caption')"></p>
					      		</p>
					    	</div>
					  	</div>
					</div>

					<div class="field is-horizontal">
					  	<div class="field-label is-normal">
					    	<label class="label">*Description</label>
					  	</div>
					  	<div class="field-body">
					    	<div class="field">
					      		<div class="control">
					        		<input v-model="photosForm.description" required class="input" type="text">
					      		</div>
					      		<p class="help is-danger" v-if="photosForm.errors.has('description')" v-text="photosForm.errors.get('description')"></p>
					      		</p>
					    	</div>
					  	</div>
					</div>

			        <image-upload name="file" class="none" @loaded="onPhotoLoad"></image-upload>
			        <div class="section">
				        <button type="submit" class="button large">Attach Photo</button>
			        </div>
			    </form>
			</div>
		</div>
		<h2 class="is-size-3">Photos you have added</h2>
		<div class="section photos-container">
			<span v-for="(photo, index) in photos">
				<figure class="image is-128x128">
				  <img :src="photo.url">
				</figure>
			  	<h3 class="is-size-4" v-text="photo.caption"></h3>
			  	<p v-text="photo.description"></p>
			  	<button @click="remove(index, photo.id)">Remove</button>
			</span>
		</div>
	</div>
</template>

<script>
import ImageUpload from '../components/ImageUpload';
export default {
	components: {
		ImageUpload
	},
	props: ['school','photosdata'],

	data () {
		return {
			logo: this.school ? this.school.logo_path : '',
			photos: this.photosdata != undefined ? this.photosdata : [],
			tempImage: '',
			photosForm: new Form({
				'caption': '',
				'description': '',
				'schools_id': this.school.id,
			}),
		}
	},

	methods: {
		onLoad(image) {
            this.logo = image.src;

            this.persist(image.file);
        },

        persist(file) {
            let data = new FormData();

            data.append('logo', file);

            axios.post(`/api/${this.school.slug}/addlogo`, data)
                .then(() => flash('Logo Uploaded Successfully! '))
                .catch(() => flash('Logo Upload Failed','failed'));
        },

        onPhotoLoad(image) {
        	this.tempImage = image.src;
        },

        addPhoto() {
        	let data = new FormData();
        	data.append('file', this.photosForm.file);
        	data.append('caption', this.photosForm.caption);
        	data.append('description', this.photosForm.description);

        	axios.post(`/school/${this.school.slug}/addphoto`, data)
                .then(data => {
                	flash('Photo Uploaded Successfully! ')
                	this.photos.push({url: data.data, caption: this.photosForm.caption, description: this.photosForm.description});
                	this.resetPhotosForm();
                })
	            .catch(() => flash('Photo Upload Failed','failed'));
        },

        remove(index, id) {
        	this.photos.splice(index, 1);
        	axios.delete(`/schoolphotos/${id}/removephoto`)
        	.catch(() => flash('Sorry! Something went wrong','failed'))
        },

        resetPhotosForm() {
        	this.photosForm.caption = '';
        	this.photosForm.description = '';
        }
	}
};
</script>

<style scoped>
	.photos-container {
		display: flex;
	    justify-content: space-between;
	    flex-wrap: wrap;
	}
</style>