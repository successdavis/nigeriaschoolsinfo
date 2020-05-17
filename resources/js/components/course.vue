<template>
	<article class="media">
	  <figure class="media-left">
	    <p class="image is-32x32">
	      <img :src="course.logo_path">
	    </p>
	  </figure>
	  <div class="media-content">
	    <div class="content columns">
	    	<span class="column" :class="showChecked ? 'is-12' : 'is-9' " v-text="course.name"></span>
	    	<span class="column is-3" v-if="!showChecked"><input placeholder="Jamb Points" class="input" type="text" v-model="cutoffpoints"></span>
	    </div>
	  </div>
	  <div class="media-right">
	    <div class="is-danger">
	    	
			
			<span class="is-pointer" v-if="!showChecked" @click="attachItem">
				<span class="icon has-text-warning">
			  		<i class="fas fa-check"></i>
				</span>
				<span>Attach</span>
			</span>
			<span class="is-pointer" v-if="showChecked" @click="detachItem">
				<span class="icon has-text-warning">
			  		<i class="fas fa-exclamation-triangle"></i>
				</span>
				<span>Detached</span>
			</span>
		</div>
	  </div>
	</article>
</template>

<script>
    import attachmentmixins from '../mixins/attachmentmixins';

	export default {
        mixins: [attachmentmixins],

	};
</script>

<style scoped>
	.is-pointer {
		cursor: pointer;
	}
</style>