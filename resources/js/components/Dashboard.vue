<script>
    export default {
        props: {
          mode: {
            default: 'overlay'
          },
          desktop: {
            default: false,
          },

          drawerstatus: {
            default: false,
          }
        },

        computed: {
            modeclass () {
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
