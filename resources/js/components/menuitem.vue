<template>
	<div>
		<p class="menu-label" v-if="type == 'menu-label'">
	        <slot></slot>
	    </p>


		<li style="margin-bottom: .3em;" v-if="link">
	      <router-link :to="link">
		        <span class="icon"><i class="mdi" :class="icon"></i></span>
		        <span :class="props.drIsOpen ? 'is-visible' : '' " class="dashboardlabel Label">
		        	<slot></slot>
		        </span>
	      </router-link> 
	    </li>
	    <li v-if="type === 'dropdown' ">
	      <a class="" @click="expandMenu" style="display: flex;">
	      	<span class="icon"><i class="mdi" :class="icon"></i></span>
	      	<span :class="props.drIsOpen ? 'is-visible' : '' " class="dashboardlabel Label"><slot></slot></span>
	      	<i v-if="props.drIsOpen" class="mdi mdi-arrow-down-bold-box" style="margin-left: auto"></i>
	      </a>
	      <ul v-if="is_expanded">
		      <router-link :to="item.link" v-for="(item, index) in items" :key="item.title">
		        <!-- <span class="icon"><i class="mdi" :class="item.icon"></i></span> -->
		        <span :class="props.drIsOpen ? 'is-visible' : '' " class="dashboardlabel Label">
		        	{{item.label}}
		        </span>
		      </router-link> 
	      </ul>
	    </li>
    </div>
</template>

<script>
	export default {
		props: {
			props: {required: false},
			label: {default: 'item'},
			icon: {default: 'mdi-view-list'},
			link: {default: ''},
			selected: {default: false},
			type: {default: 'link'},
			items: Array,
		},

		data () {
			return {
				is_expanded: false,
			}
		},

		created() {
			Event.$on('drawerisclosed', () => this.is_expanded = false);
		},

		methods: {
			expandMenu() {
				this.is_expanded = !this.is_expanded,
				Event.$emit('expanddrawer');	
			},
		}
	}
	
</script>

<style scoped="">
	.router-link-exact-active {
		background: white;
		color: black;
	}

	.icon {
		font-size: 1.2em;

	}

	.dashboardlabel, .icon {
		color: #727c8f;
	}

</style>