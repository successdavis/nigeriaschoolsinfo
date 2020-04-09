<template>
    <div >
        <article class="media">
            <figure class="media-left">
                <p class="image is-32x32 is-rounded">
                <img class="is-rounded" src="https://bulma.io/images/placeholders/32x32.png">
                </p>
            </figure>
          <div class="media-content">
            <div class="content">
              <p>
                <strong>
                    <a class="has-text-black" :href="'/profiles/'+comment.owner.username">
                        {{comment.owner.name}}
                    </a>  said: {{comment.created_at}}
                </strong>
                <br>
                <div v-if="editing">
                    <form @submit="update">
                        <textarea class="textarea" v-model="body" required></textarea>
                        <button class="small button">Update</button>
                        <button class="small button" @click="editing = false" type="button">Cancel</button>
                    </form>
                </div>
                <div v-else v-text="body"></div>
              </p>
            </div>
            <nav class="level is-mobile">
              <div class="level-left">
                <a class="level-item">
                  <span class="icon is-small"><i class="fas fa-reply"></i></span>
                </a>
                <a class="level-item">
                  <span class="icon is-small"><i class="fas fa-heart"></i></span>
                </a>
              </div>
            </nav>
            <comment v-for="(comment, index) in items[id]" :key="comment.id" :comment="comment" :items="items" @deleted="remove(index)"></comment>
            
            <new-comment :comment_id="id"></new-comment>

          </div>
        </article>
    </div>
</template>

<script>
    import NewComment from './NewComment.vue';
    import comment from './comment.vue';

    // import Favorite from './Favorite.vue';
    export default {
        props: ['comment','items'],

        components: { comment, NewComment },

        data() {
            return {
                editing: false,
                id: this.comment.id,
                body: this.comment.body,
                isBest: this.comment.isBest,
            };
        },

        // created () {
        //     window.events.$on('best-reply-selected', id => {
        //         this.isBest = (id === this.id);
        //     });
        // },

        methods: {
            add(item) {
                this.items[this.id].push(item);

                this.$emit('added');
            },
            // update() {
            //     axios.patch(
            //         '/replies/' + this.id, {
            //         body: this.body
            //     })

            //     .catch(error => {
            //         flash(error.response.reply, 'danger');
            //     });

            //     this.editing = false;

            //     flash('updated!');
            // },

            // destroy() {
            //     axios.delete('/replies/' + this.reply.id);

            //     this.$emit('deleted', this.reply.id);
            // },

            // markBestReply() {
            //     axios.post('/replies/' + this.reply.id + '/best');

            //     window.events.$emit('best-reply-selected', this.reply.id);

            // }
        }
    };
</script>

<style scoped>
    .bestreply {
        padding: .5em;
        border-radius: .5em;
    }
</style>