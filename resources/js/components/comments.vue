
<template>
    <div>
        <div v-for="(comment, index) in items.root" :key="comment.id">
            <comment :comment="comment" :items="items" @deleted="remove(index)"></comment>
        </div>
        <paginator :dataSet="dataSet" @changed="fetch"></paginator>
<!--         <p v-if="$parent.locked">
            This thread has been locked. No more replies are allowed.
        </p> -->
        <new-comment @created="add" ></new-comment>
    </div>
</template>

<script> 
    import NewComment from './NewComment.vue';
    import collection from '../mixins/collection';

    export  default {
        components: {NewComment},
 
        mixins: [collection],
        data() {
            return { dataSet: false };
        },

        created() {
            this.fetch();
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
                this.items['root'].push(item);
            },
        }
    }
</script>
