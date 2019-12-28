<script>
    import _ from 'lodash';
	export default {
		data () {
			return {
				isLoading: false,
				schools: '',
				path: '',
                dataSet: '',
                pagination: '',
                searchKey: '',
                page: '',
			}
		},

		created () {
			this.fetch();
		},

		methods: {
			getSchools() {
                axios.get('/schools/')
                    .then(this.refresh);
            },

            search: _.debounce(function(page) {
                this.path = '';
                this.isLoading = true;
                this.fetch(this.page);
            }, 700),

            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                if (this.searchKey != '') {
                    return `/schools?s=${this.searchKey}`;
                }

                if (this.path) {
                    return `${this.path}&page=${page}`;
                }
                return `${location.pathname}?page=${page}`;

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
                this.schools = data.data;
                this.pagination = data;

                window.scrollTo(0, 0);
            },

            sort() {
                this.searchKey = '';
                this.fetch(this.page);
            },
		}
	}
</script>