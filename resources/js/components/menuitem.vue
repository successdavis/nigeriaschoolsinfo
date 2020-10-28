<template>
	<p class="menu-label" v-if="type == 'menu-label'">
        <slot></slot>
    </p>
	<li v-else>
      <router-link :to="link">
        <span class="icon"><i class="mdi" :class="icon"></i></span>
        <transition name="fade">
	        <span :class="props.drIsOpen ? 'is-visible' : '' " class="dashboardlabel Label">
	        	<slot></slot>
	        </span>
	    </transition>
      </router-link> 
    </li>
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