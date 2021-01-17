export default {
	data() {
        return {
            courses: [],
            dataSet: '',
            pagination: '',
            searchKey: '',
            page: '',
            checkedFaculty: [],
            isLoading: false,
            sort: '',
        };
    },

    created () {
        this.fetch();
    },

    watch: {
        sort() {
            this.fetch();
        }
    },

    methods: {
        setOptions (e) {
            this.checkedFaculty = [e.target.value];
            this.sort = e.target.value;
        },
        fetch(page) {
            axios.get(this.url(page)).then(this.refresh);
        },

        url(page) {
            if (! page) {
                let query = location.search.match(/page=(\d+)/);

                page = query ? query[1] : 1;
            }

            if (this.sort) {
                return `${location.pathname}?faculty=${this.sort}`;
            }

            return `${location.pathname}?page=${page}&s=${this.searchKey}`;

        },

        refresh({data}) {
            this.isLoading = false;
            this.courses = data.data;
            this.pagination = data;
            this.dataSet = {
                next_page_url : data.links.next,
                current_page: data.meta.current_page,
                per_page: data.meta.per_page,
                total: data.meta.total,
                from: data.meta.from,
                last_page: data.meta.last_page,
                prev_page_url: data.links.prev
            };
        },

        search: _.debounce(function(page) {
            this.sort = '';
            this.isLoading = true;
            this.fetch(this.page);
        }, 700),
    }
}