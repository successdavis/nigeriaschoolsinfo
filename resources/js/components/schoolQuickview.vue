<template>	
	<div>	
		<span @click="$modal.show(name)" class="mg_left-auto image__favicon--small"><i class="mdi mdi-book-open-variant"></i></span>
			<modal
				:name="name"
				@before-open="beforeOpen"
				@before-close="beforeClose"
				height="auto"
				:adaptive="true"
				scrollable="scrollable"
			>
				<div class="section">
					<div class="model-close-btn button" @click="$modal.hide(name)">Close</div>
					<div class="is-size-4 has-text-centered" v-text="school.short_name + ' courses offered'"></div>
					<article class="media" v-for="(course, index) in courses">
					  <div class="media-content">
					    <div class="content">
					      <p>
					        <strong v-text="course.name"></strong> <small v-text="course.duration + ' years'"></small>
					      </p>
					    </div>
					  </div>
					</article>
				  <infinite-loading @infinite="infiniteHandler"></infinite-loading>
				</div>
			</modal>

	</div>

</template>

<script>
	export default {
		props: ['school','name'],
		data () {
			return {
				page: 1,
				courses: [],
			}
		},

		methods: {
			infiniteHandler($state) {
		      axios.get(`/courses-offered-in/${this.school.slug}`, {
		        params: {
		          page: this.page,
		        }, 
		      }).then(({ data }) => {
		        if (data.data.length) {
		          this.page += 1;
		          this.courses.push(...data.data);
		          $state.loaded();
		        } else {
		          $state.complete();
		        }
		      });
		    },

		    beforeOpen(event) {
		    	let body = document.querySelector('body')
		    	body.style.overflowY = "hidden"
		    },

		    beforeClose(event) {
		    	let body = document.querySelector('body');
		    	body.style.overflowY = "auto"
		    },
		}
	};
</script>

<style>	
	.model-close-btn {
		position: fixed;
		right: 10px;
		top: 20px;
	}
</style>