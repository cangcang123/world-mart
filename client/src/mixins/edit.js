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
            item: null,
            loading: false,
        }
    },
    computed: {
        editFields() {
            return this.displayFields.map(key => this.fields.find(f => f.key === key))
                .filter(f => f)
        }
    },
    created() {
        this.$service = new CURD(this.entry)
        if (!this.displayFields.length) {
            this.displayFields = this.fields.map(f => f.key)
        }
    },
    methods: {
        async getData() {
            this.loading = true
            let item = await this.$service.detail(this.id)
            if (typeof this.afterGotData === 'function') {
                this.afterGotData(item)
            }
            this.item = item
            this.loading = false
        },
        async save() {
            this.loading = true
            if (typeof this.beforeSave === 'function') {
                if (this.beforeSave() === false) return
            }
            let item = await this.$service.update(this.id, this.item).catch(err => {
                this.$bvToast.toast(err.response && err.response.data && err.response.data.message || err.message, {
                    title: 'Error',
                    variant: 'danger'
                })
            })
            if (typeof this.afterSave === 'function') {
                this.afterSave(item)
            }
            if (item) {
                this.item = item
                this.$bvToast.toast('Item has been updated', {
                    title: 'Success',
                    variant: 'success'
                })
                // this.$vs.notify({
                //     color: 'primary',
                //     title: 'Success',
                //     text: 'Item has been updated',
                //     position:'top-right',
                // })
            }
            this.loading = false
        },
        requestDelete() {
            this.$bvModal.msgBoxConfirm('Please confirm that you want to delete this item.', {
                    title: 'Please Confirm',
                    okVariant: 'danger',
                    okTitle: 'YES',
                }).then(async confirmed => {
                    if (confirmed) {
                        let res = await this.$service.delete(this.id)
                        if (res) {
                            this.$router.back()
                            this.$message({
                                message: 'This item deleted successful',
                                type: 'warning'
                            })
                        } else {
                            this.$message.error('⚠️☠️⛔ Oops!')
                        }
                    }
                })
                .catch(err => {
                    console.log(err.message)
                })
        }
    }
}