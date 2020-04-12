<template>
	<article class="media">
	  <figure class="media-left">
	    <p class="image is-32x32">
	      <img :src="course.logo_path">
	    </p>
	  </figure>
	  <div class="media-content">
	    <div class="content"v-text="course.name">
	    	
	    </div>
	  </div>
	  <div class="media-right">
	    <div class="is-danger">
	    	<span class="icon has-text-warning">
		  		<i class="fas fa-check" v-if="showChecked"></i>
			</span>
			<span class="icon has-text-warning" v-if="! showChecked">
		  		<i class="fas fa-exclamation-triangle"></i>
			</span>
			<span style="cursor: pointer" v-if="showChecked" @click="attachItems">Attach</span>
			<span style="cursor: pointer" v-if="!showChecked" @click="detachedItems">Detached</span>
		</div>
	  </div>
	</article>
</template>

<script>
    import attachmentmixins from '../mixins/attachmentmixins';

	export default {
        mixins: [attachmentmixins],

	}
</script>