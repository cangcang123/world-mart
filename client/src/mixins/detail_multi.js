import CURD from "@/services/curd"

export default {
    props: {
        id: {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            fields: [],
            displayFields: [],
            item: [],
            loading: false,
        }
    },
    computed: {
    },
    created() {
        this.$service = {}
        this.entries.forEach(entry => {
            this.$service[entry.path] = new CURD(entry.path)
        });
        if (!this.displayFields.length) {
            this.displayFields = this.fields.map(f => f.key)
        }
    },
    methods: {
        async getData() {
            this.loading = true
            this.item = []
            let init_id = this.id

            let result = await this.entries.reduce(async (prev, curr, i) => {
                let data = null
                if(i == 0) {
                    data = await this.$service[curr.path].detail(init_id)
                } else {
                    let prev_data = await prev
                    data = await this.$service[curr.path].detail(prev_data[curr.key])
                }
                this.item.push({...data})
                return data
            }, Promise.resolve())
            if (typeof this.afterGotData === 'function') {
                this.afterGotData(this.item)
            }
            this.loading = false
        },
    }
}