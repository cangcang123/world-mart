import CURD from '@/services/curd'

export default {
    data() {
        return {
            fields: [],
            displayFields: [],
            item: {}
        }
    },
    computed: {
        addFields() {
            if (this.displayFields.length) {
                return this.displayFields.map(k => this.fields.find(f => f.key === k)).filter(f => f)
            }
            return this.fields.filter(f => !f.readonly)
        }
    },
    created() {
        this.$service = new CURD(this.entry)
        this.addFields.forEach(field => {
            if (this.item[field.key] === undefined) {
                this.$set(this.item, field.key, field.default === undefined ? '' : field.default)
            }
        })
    },
    methods: {
        async create() {
            if (typeof this.beforeCreate === 'function') {
                if (this.beforeCreate() === false) {
                    return
                }
            }
            let item = await this.$service.create(this.item)
            if (typeof this.afterCreated === 'function') {
                this.afterCreated(item)
            }
        },
    }
}