<script>
	export default {
		data () {
			return {
				isLoading: false,
				schools: '',
				type: '',
			}
		},

		created () {
			this.getSchools();
		},

		methods: {
			getSchools() {
                axios.get('/schools/')
                    .then(data => {
                            this.schools = data.data;
                        }
                    );
            },

		}

		methods: {
            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }
                return `${location.pathname}/${this.sort}?page=${page}&column=${this.sortedColumn}&order=${this.order}&per_page=${this.perPage}`;
            },

            sortByColumn(column) {
                if (column === this.sortedColumn) {
                    this.order = (this.order === 'asc') ? 'desc' : 'asc'
                } else {
                    this.sortedColumn = column;
                    this.order = 'asc'
                }

                this.fetch()
            },

            refresh({data}) {
                this.dataSet = {
                    next_page_url : data.links.next,
                    current_page: data.meta.current_page,
                    per_page: data.meta.per_page,
                    total: data.meta.total,
                    prev_page_url: data.links.prev
                };
                this.items = data.data;
                this.pagination = data;

                window.scrollTo(0, 0);
            },
        }
	}
</script>