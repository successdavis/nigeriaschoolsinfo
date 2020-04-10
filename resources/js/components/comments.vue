
<template>
    <div>
        <div v-for="(comment, index) in items.root" :key="comment.id">
            <comment :comment="comment" :items="items" @deleted="remove(index)"></comment>
        </div>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
        <p v-if="locked">
            This thread has been locked. No more replies are allowed.
        </p>
        <new-comment @created="add" v-else></new-comment>
    </div>
</template>

<script> 
    import NewComment from './NewComment.vue';
    import collection from '../mixins/collection';

    export  default {
        components: {NewComment},
        
        props: ['post'],

        mixins: [collection],
        data() {
            return { 
                locked: this.post.locked,
                dataSet: false,
            };
        },

        created() {
            this.fetch();
        },

        mounted() {
             window.events.$on(
                'childcomment', data => {
                    if (this.items.hasOwnProperty(data.parent_id)) {
                        this.items[data.parent_id].push(data)
                    }else {
                  window.location.replace(window.location.pathname + window.location.search + window.location.hash);

                    }
                }
            );
        },

        methods: {
            fetch(page) {
                axios.get(`${location.pathname}/comments`).then(this.refresh);
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data;
            },

            add(item) {
                if (this.items.hasOwnProperty('root')) {
                    this.items['root'].push(item);
                }else {
                    this.items = {root: [item]};
                }
            },
        }
    }
</script>
