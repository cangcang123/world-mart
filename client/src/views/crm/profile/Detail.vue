<template>
    <div class="centerx">
        <vs-popup id="modal-detail" fullscreen title="User Profile" :active.sync="showPopup" @close="onHide">
            <div v-if="item">
                <b-container fluid="xl">
                    <b-row>
                        <b-col cols="6">
                            <b-table stacked :items="items" :fields="leftTableFields">
                                <template v-slot:cell(gender)="data">
                                    <b-badge v-if="data.value === 1" variant="success">Nam</b-badge>
                                    <b-badge v-if="data.value === 2" variant="warning">Nữ</b-badge>
                                </template>
                            </b-table>
                        </b-col>
                        <b-col cols="6">
                            <b-table stacked :items="items" :fields="rightTableFields">
                                <template v-slot:cell(status)="data">
                                    <b-badge v-if="data.value === 0" variant="warning">Inactive</b-badge>
                                    <b-badge v-if="data.value === 1" variant="success">Active</b-badge>
                                </template>

                                <template v-slot:cell(deleted)="data">
                                    <b-badge v-if="data.value === 0" variant="primary">No</b-badge>
                                    <b-badge v-if="data.value === 1" variant="danger">Yes</b-badge>
                                </template>
                            </b-table>
                        </b-col>
                    </b-row>
                </b-container>
            </div>
            <div v-else>
                <div class="text-center">
                    <strong>Không có dữ liệu</strong>
                </div>
            </div>
        </vs-popup>
    </div>

</template>

<script>
import fields from './fields'
import Edit from '@/mixins/edit'
import geo from '@/services/geo'
import CURD from '@/services/curd'

export default {
    props: ['id'],
    mixins: [Edit],
    data() {
        return {
            showPopup: false,
            leftKeys: [
                "provider",
                "provider_id",
                "full_name",
                "gender",
                "dob",
                "status"
            ],
            rightKeys: [
                "phone",
                "email",
                "address",
                "province",
                "district",
                "ward",
            ],
            fields,
            provinces: [],
            districts: [],
            wards: [],
            entry: 'crm/user-profile'
        }
    },
    computed: {
        leftTableFields() {
            return this.leftKeys.map(key => this.fields.find(f => f.key == key) || key)
        },
        rightTableFields() {
            return this.rightKeys.map(key => this.fields.find(f => f.key == key) || key)
        },
        items() {
            return [
                {
                    ...this.leftKeys.reduce((item, key) => {
                        this.$set(item, key, this.item && this.item[key])
                        return item
                    }, {}),
                    ...this.rightKeys.reduce((item, key) => {
                        this.$set(item, key, this.item && this.item[key])
                        return item
                    }, {})
                }
            ]
        },
    },
    mounted() {
        if(this.id) {
            this.getData()
            this.show()
        }
    },
    methods: {
        async afterGotData(item) {
            // Edit province
            if (!this.provinces.length) {
                this.provinces = await geo.getProvinces()
            }

            let province = this.provinces.find(d => d.code == item.province_code)
            if (province)  {
                this.$set(item, 'province_code', province.name)
            }

            if (item.zalo_id_by_oa) {
                let service = new CURD('crm/tracking-click/count-by-url')
                let filter = {
                    zalo_id_by_oa: item.zalo_id_by_oa
                }
                let count = await service.list(filter)
                this.$set(item, 'view_engagement', count)
            }
        },
        show() {
            this.showPopup = true
        },
        onHide() {
            this.item = null
            this.$emit("update:id", null)
        }
    },
    watch: {
        id(val) {
            let query = Object.assign({}, this.$route.query)
            if(val) {
                this.getData()
                this.show()
                this.$router.push({path: this.$route.path, query: {...query, id: val}})
            } else {
                this.$router.push({path: this.$route.path, query: {...query, id: undefined}})
            }
        }
    }
}
</script>

<style lang="scss">
#modal-detail {
    .b-table-stacked > tbody > tr > [data-label]::before {
        text-align: left;
    }
}
</style>