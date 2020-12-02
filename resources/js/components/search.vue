<template>
    <section>
        <b-field :label="setup.label">
            <b-autocomplete
                v-model="name"
                placeholder="e.g. Anne"
                :keep-first="keepFirst"
                :open-on-focus="openOnFocus"
                :data="filteredDataObj"
                :field="setup.title"
                @select="option => (selected = option)"
                :clearable="clearable"
                @input="getData"
            >
            </b-autocomplete>
        </b-field>
    </section>
</template>

<script>
export default {
    props: {
        setup: {required: true},
        source_title: {default: ''},
    },
    data() {
        return {
            data: [],
            keepFirst: true,
            openOnFocus: false,
            name: this.source_title,
            selected: null,
            clearable: true,
        }
    },
    computed: {
        filteredDataObj() {
            return this.data.filter(option => {
                return (
                    option[this.setup.title]
                        .toString()
                        .toLowerCase()
                        .indexOf(this.name.toLowerCase()) >= 0
                )
            })
        }
    },

    watch: {
        selected: function () {
            this.$emit('userselected', this.selected);
        }
    },

    methods: {
        getData: _.debounce(function(value) {
            if(value.length < 1) {return this.data = []}
            this.path = '';
            this.isLoading = true;
            this.fetch(value);
        }, 700),

        fetch(value) {
            axios.get(`${this.setup.url}?s=${value}`) .then (data => {
                this.data = data.data.data
            })
        }
    }
}
</script>