<template>
    <transition 
        name="custom-classes-transition"
        enter-active-class="animated slideInDown fast"
        leave-active-class="animated slideOutUp"
    >
        <div class="alert alert-flash"
             :class="'alert-'+level"
             role="alert"
             v-show="show"
             v-text="body">
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: this.message,
                level: 'success',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash();
            }

            window.events.$on(
                'flash', data => this.flash(data)
            );
        },

        methods: {
            flash(data) {
                if (data) {
                    this.body = data.message;
                    this.level = data.level;
                }

                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    };
</script>

<style>
    .alert-flash {
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 2002;
        text-align: center;
        color: white;
        padding: 1em 0;
    }

    .alert-success {
        background: blue;
    }

    .alert-failed {
        background: red;
    }
</style>
