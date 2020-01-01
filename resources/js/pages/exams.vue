<script>
    import _ from 'lodash';
	export default {
		data () {
			return {
				exams: [],
				isLoading: false,
                pagination: '',
                dataSet: '',
                status: '',
                searchKey: '',
			}
		},

		created () {
			this.fetch();
		},

		methods: {
			fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                // if (this.searchKey != '') {
                //     return `/schools?s=${this.searchKey}`;
                // }

                // if (this.path) {
                //     return `${this.path}&page=${page}`;
                // }
                return `${location.pathname}?page=${page}&status=${this.status}&s=${this.searchKey}`;

            },

            refresh({data}) {
                this.isLoading = false;
                this.dataSet = {
                    next_page_url : data.links.next,
                    current_page: data.meta.current_page,
                    per_page: data.meta.per_page,
                    total: data.meta.total,
                    from: data.meta.from,
                    last_page: data.meta.last_page,
                    prev_page_url: data.links.prev
                };
                this.exams = data.data;
                this.pagination = data;

                window.scrollTo(0, 0);
            },

            sortItems () {
                this.fetch();
            },

            search: _.debounce(function(page) {
                // this.sort = '';
                this.isLoading = true;
                this.fetch(this.page);
            }, 700),
		}
	}
</script>