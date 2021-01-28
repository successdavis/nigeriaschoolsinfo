<template>
    <div>
        <div v-if="signedIn">
            <label>
                <textarea class="textarea" placeholder="Have something to say" name="body" rows="5" v-model="body" required></textarea>
                <button :disabled="processing" type="submit" class="success button" @click="addComment">POST</button>
            </label>
        </div>
        <div v-else>
            <p class="text-center">Please <a href="/login">Sign In</a> in to participate in the Conversation</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['comment_id','commentable_type','commentable_id'],
        data() {
            return {
                processing: false,
                body: '',
                parent_id: this.comment_id,
                endpoint: this.endpoint,
            };
        },

        methods: {
            addComment() {
                this.processing = true;
                axios.post('/comments/newcomment', { 
                        body: this.body,  
                        parent_id: this.parent_id,
                        commentable_type: this.commentable_type,
                        commentable_id: this.commentable_id,
                    })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your reply has been posted.');
                        this.processing = false;
                        this.$emit('created', data);
                    })
                    .catch(error => {
                        console.log(error)
                        flash(error.response.data, 'danger');
                        this.processing = false;
                    });
            }
        }
    }
</script>