<template>
	<aside class="menu">
	    <p class="menu-label" v-if="type = 'menu-label' ">
	        General
	    </p>

	    <ul class="menu-list" v-else>
			<li>
		      <router-link :to="link">
		        <span class="icon"><i class="mdi" :class="icon"></i></span>
		        <span :class="props.drIsOpen ? 'is-visible' : '' " class="dashboardlabel Label">
		        	<slot></slot>
		        </span>
		      </router-link> 
		    </li>
		</ul>
	</aside>
</template>

<script>
	export default {
		props: {
			props: {required: true},
			label: {default: 'item'},
			icon: {default: 'mdi-view-list'},
			link: {default: '//'},
			selected: {default: false},
			type: {default: ''},
		},

		data () {
			return {

			}
		},
	}
	
</script>

<style scoped="">
	.router-link-exact-active {
		background: white;
		color: black;
	}
</style>