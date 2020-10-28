<template>
  <div class="dashboard-wrapper" :class="drIsOpen ? modeclass : 'drIsClose' ">
      <div :class="desktop == true ? 'is-desktop' : '' " class="n_drawer navbar-wrapper__child left">
          
          <slot :drIsOpen="drIsOpen" name="drawermenu"></slot>
      </div>
      <div class="drawer_overlay is-hidden-tablet" v-if="drIsOpen" @click="drIsOpen = false" v-cloak></div>

      <nav :class="desktop == true ? 'is-desktop' : '' " class="navbar navbar-wrapper__child" role="navigation" aria-label="main navigation">
          <div class="navbar-brand is-flex-touch justify-content-touch">
              <a :class="desktop == true ? 'is-desktop' : '' "   @click.prevent="drIsOpen = !drIsOpen" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false">
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
                  <span aria-hidden="true"></span>
              </a>
              <a class="navbar-item" href="/">
                  <h3 v-text="title"></h3>
              </a>
              
              <a class="navbar-item is-hidden-desktop">
                  (?)
              </a>
          </div>
          <div id="navbarBasicExample" class="navbar-menu">
            <slot name="navigation"></slot>
        </div>
      </nav>

      <div :class="desktop == true ? 'is-desktop' : '' " class="dashboard_content section">
          
          <!-- Site main content goes here -->
          <slot name="dashboardcontent"></slot>

      </div>
  </div>
</template>


<script>
    export default {
        props: {
          title: {default: 'admin'},
          mode: {default: 'overlay'},
          desktop: {default: false,},
          drawerstatus: {default: false,}
        },

        computed: {
          modeclass(){
                return this.mode === 'push' ? 'n_drawer-is-open-mobile-left-push' : 'n_drawer-is-open-mobile-left-overlay'
            }
        },

        data () {
        	return {
        		completeRate: 0,
            drIsOpen: this.drawerstatus,
        	}
        },
    };
</script>

<style scoped>
    .ps-full-width {
        min-width: 100%;
    }

    
</style>
