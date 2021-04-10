import { mapGetters } from 'vuex'
import CURD from '@/services/curd'

export default {
    provide() {
        return {
            pagination: this.pagination,
            defaultFilter: this.defaultFilter,
            filter: this.filter,
            fields: this.fields,
            displayFields: this.displayFields,
            where: this.where,
            entry: this.entry
        }
    },
    data() {
        let currentPage = parseInt(this.$route.query.page) || 1

        return {
            fields: [],
            displayFields: [],
            appendColumns: [],
            items: [],
            itemsSelected: [],
            defaultFilter: {},
            filter: {},
            where: {},
            sort: '',
            defaultSort: undefined,
            pagination: {
                currentPage,
                perPage: 12,
                total: 0
            },
            loading: false
        }
    },
    computed: {
        ...mapGetters({
            storeDisplayFields: 'layout/display_fields'
        }),
        tableFields() {
            let displayFields = this.storeDisplayFields(this.entry)
            if (!displayFields.length) {
                displayFields = this.displayFields
            }
            return this.fields
                .filter(f => displayFields.includes(f.key))
                .concat(this.appendColumns)
        }
    },
    async created() {
        for (const key in this.defaultFilter) {
            if (this.$route.query[key] !== undefined) {
                let value = this.$route.query[key]
                if (!isNaN(value) && key != 'oa_id') value = +value
                this.$set(this.filter, key, value)
            }
        }

        this.$service = new CURD(this.entry)
        this.$store.dispatch('layout/getFields', this.entry).then(displayFields => {
            if (displayFields.length) {
                this.displayFields = displayFields
            }
        })
    },
    methods: {
        async getData() {
            let page = Math.max(1, this.pagination.currentPage)
            let limit = this.pagination.perPage
            let offset = (page - 1) * limit
            let sort = this.sort || this.defaultSort
            let filter = Object.assign({}, this.defaultFilter, this.filter)
            filter = Object.assign({}, this.where, this.filter)

            this.loading = true
            let res = await this.$service.list({
                sort,
                filter,
                offset,
                limit
            })
            this.loading = false

            if (res) {
                this.items = res.entries || []

                this.pagination.perPage = res.pageInfo.perPage
                this.pagination.total = res.totalCount
                this.$nextTick(() => {
                    this.pagination.currentPage = res.pageInfo.currentPage
                })

                if (typeof this.afterGotData === 'function') {
                    this.afterGotData(this.items)
                }
            }
        },
        async exportExcel(type, time) {
            this.modalShow = true
            let sort = this.sort || this.defaultSort
            let filter = Object.assign({}, this.defaultFilter, this.filter)
            let displayFields = this.storeDisplayFields(this.entry)
            if (!displayFields.length) {
                displayFields = this.displayFields
            }

            this.loading = true
            this.$service.export({
                sort,
                type: type,
                time: time,
                filter,
                fields: displayFields
            })
            .catch(() => {
                this.$bvToast.toast('Không thể export dữ liệu', { variant: 'danger', title: 'Lỗi' })
            })

            this.loading = false
        },
        onFilterChanged() {
            this.pagination.currentPage = 1
            this.getData()
        },
        onSortChanged(sort) {
            if (sort.sortBy) {
                let prefix = sort.sortDesc ? '-' : ''
                this.sort = prefix + sort.sortBy
            }
            else {
                this.sort = ''
            }
            this.getData()
        },
        async showConfirmDeleteModal() {
            await this.$bvModal.msgBoxConfirm(`Please confirm that you want to delete ${this.itemsSelected.length} rows.`, {
                title: 'Please Confirm',
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'danger',
                okTitle: 'YES',
                cancelTitle: 'NO',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
            .then(value => {
                this._deleteSelectedRows()
            })
            .catch(err => {
            })

            this.getData()
        },
        _rowSelected(items) {
            this.itemsSelected = items
        },
        _deleteSelectedRows() {
            this.$service.deleteByIds(this.itemsSelected.map(i => i.id))
        }
    },
    beforeRouteUpdate(to, _from, next) {
        this.pagination.currentPage = parseInt(to.query.page) || 1
        next()
    },
    watch: {
        'pagination.currentPage'(val) {
            if (val != this.$route.query.page) {
                this.$router.push({
                    path: this.$route.path,
                    query: Object.assign({}, this.$route.query, { page: val })
                })
            }
            this.$nextTick(() => {
                this.getData()
            })
        }
    }
}
