<template>

    <nav class="pagination is-rounded" role="navigation" aria-label="pagination" v-if="shouldPaginate">
      <a class="pagination-previous" v-show="prevUrl" rel="Previous" @click.prevent="page--">Previous</a>
      <a class="pagination-next" v-show="nextUrl" @click.prevent="page++" rel="next">Next page</a>
      <ul class="pagination-list">
        <li><a class="pagination-link" aria-label="Goto page 1" @click.prevent="page = 1">1</a></li>
        <li><span class="pagination-ellipsis">&hellip;</span></li>
        <li v-show="current_page > 1"><a class="pagination-link" aria-label="Goto page 45" @click.prevent="page--">{{current_page - 1}}</a></li>
        <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page"> {{current_page}}</a></li>
        <li v-show="current_page != last_page"><a class="pagination-link" aria-label="Goto page 47" @click.prevent="page++">{{current_page + 1}}</a></li>
        <li><span class="pagination-ellipsis">&hellip;</span></li>
        <li><a class="pagination-link" aria-label="Goto page 86" @click.prevent="page = last_page">{{last_page}}</a></li>
      </ul>
    </nav>
</template>

<script>
    export default {
        props: ['dataset'],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false,
                current_page: 1,
                per_page: '',
                total: '',
                from: '',
                last_page: ''
            }
        },

        watch: {
            dataset() {
                this.page = this.dataset.current_page;
                this.prevUrl = this.dataset.prev_page_url;
                this.nextUrl = this.dataset.next_page_url;
                this.current_page = this.dataset.current_page;
                this.per_page = this.dataset.per_page;
                this.total = this.dataset.total;
                this.from = this.dataset.from;
                this.last_page = this.dataset.last_page;
            },

            page() {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                this.$emit('changed', this.page);

                return this;
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
    
</script>