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
                  <span class="icon is-small" @click="newcomment = !newcomment"><i class="fas fa-reply"></i></span>
                </a>
                <a class="level-item">
                  <span class="icon is-small"><i class="fas fa-heart"></i></span>
                </a>
              </div>
              <div class="level-right">
                <a class="level-item" @click="smd = true" v-if="authorize('owns', comment)">
                    <span class="icon is-small"><i class="fas fa-trash"></i></span>
                </a>
               <a class="level-item" @click="editing = !editing" v-if="authorize('owns', comment)">
                    <span class="icon is-small"><i class="fas fa-edit"></i></span>
                </a>
                  
              </div>
            </nav>
            <div>
                <span 
                    v-if="smd">sure about this? 
                    <input type="button" class="button" @click="destroy" value="Yes">
                    <input type="button" class="button" @click="smd = false" value="No">
                </span>
            </div>
            <new-comment :comment_id="id" @created="add" v-show="newcomment"></new-comment>
            <comment class="is-hidden-mobile" v-for="(comment, index) in getItems" :key="comment.id" :comment="comment" :data="data" @deleted="remove(index)"></comment>
          </div>

        </article>
        <comment class="is-hidden-tablet" v-for="(comment, index) in getItems" :key="comment.id" :comment="comment" :data="data" @deleted="remove(index)"></comment>
    </div>
</template>

<script>
    import NewComment from './NewComment.vue';
    import comment from './comment.vue';

    // import Favorite from './Favorite.vue';
    export default {
        props: ['comment','data'],

        components: { comment, NewComment },

        data() {
            return {
                smd: false,
                newcomment: false,
                editing: false,
                id: this.comment.id,
                body: this.comment.body,
                isBest: this.comment.isBest,
                items: this.data[this.comment.id],
            };
        },

        computed: {
            getItems() {
                return this.items;
            },
            hasData() {
                return this.items != null;
            },
        },

        // created () {
        //     window.events.$on('best-reply-selected', id => {
        //         this.isBest = (id === this.id);
        //     });
        // },

        methods: {
            add(item) {
                this.newcomment = false;
                // window.events.$emit('childcomment', item);
                if (this.hasData) {
                    this.items.unshift(item);
                }else {
                    let newComment = [];
                    newComment.push(item);
                    this.items = newComment;
                }
            },

            update() {
                axios.patch(
                    '/comment/' + this.id + '/update', {
                    body: this.body
                })

                .catch(error => {
                    flash(error.response.comment, 'danger');
                });

                this.editing = false;

                flash('updated!');
            },

            destroy() {
                this.smd = false;
                axios.delete('/comment/' + this.comment.id + '/destroy');

                this.$emit('deleted', this.comment.id);
            },

            remove(index) {
                console.log(index)
                this.items.splice(index, 1);

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