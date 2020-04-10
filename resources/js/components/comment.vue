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
                  <span class="icon is-small" @click="showcomment = !showcomment"><i class="fas fa-reply"></i></span>
                </a>
                <a class="level-item">
                  <span class="icon is-small"><i class="fas fa-heart"></i></span>
                </a>
                <a class="level-item" @click="destroy" v-if="authorize('owns', comment)">
                    <span class="icon is-small"><i class="fas fa-trash"></i></span>
                </a>
              </div>
            </nav>
            <new-comment :comment_id="id" @created="add" v-show="showcomment"></new-comment>
            <comment class="is-hidden-mobile" v-for="(comment, index) in getItems" :key="comment.id" :comment="comment" :items="items" @deleted="remove(index)"></comment>
          </div>

        </article>
        <comment class="is-hidden-tablet" v-for="(comment, index) in items[id]" :key="comment.id" :comment="comment" :items="items" @deleted="remove(index)"></comment>
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
                showcomment: false,
                editing: false,
                id: this.comment.id,
                body: this.comment.body,
                isBest: this.comment.isBest,
                commentItems: this.items[this.comment.id],
            };
        },

        computed: {
            getItems() {
                return this.commentItems;
            },
            hasData() {
                return this.commentItems != null;
            },
        },

        // created () {
        //     window.events.$on('best-reply-selected', id => {
        //         this.isBest = (id === this.id);
        //     });
        // },

        methods: {
            add(item) {
                // window.events.$emit('childcomment', item);
                if (this.hasData) {
                    this.commentItems.push(item);
                }else {
                    let newComment = [];
                    newComment.push(item);
                    this.commentItems = newComment;
                }
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

            destroy() {
                axios.delete('/comment/' + this.comment.id + '/destroy');

                this.$emit('deleted', this.comment.id);
            },

            remove(index) {
                console.log(index)
                this.commentItems.splice(index, 1);

                this.$emit('removed');
            }

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