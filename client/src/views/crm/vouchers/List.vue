<template>
<page>
    <page-header>💲 User's vouchers</page-header>

    <customer-menu></customer-menu>

    <action-bar @change="onFilterChanged">
    </action-bar>

    <div class="mb-2">
        <span v-if="loading">Đang tải...</span><span v-else>Tổng {{ pagination.total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') }}</span>
    </div>

    <b-table class="bg-white shadow-sm" table-class="mb-0"
        :items="items"
        :fields="tableFields"
        :busy="loading"
        show-empty striped hover responsive selectable no-local-sorting
        @sort-changed="onSortChanged"
        @row-selected="_rowSelected">

        <template v-slot:table-busy>
            <div class="text-center my-2">
                <b-spinner class="align-middle" small variant="warning" type="grow"></b-spinner>
                <b-spinner class="align-middle" small variant="success" type="grow"></b-spinner>
                <b-spinner class="align-middle" small variant="info" type="grow"></b-spinner>
            </div>
        </template>

        <template v-slot:cell(type)="data">
            <b-badge v-if="data.value === 1" variant="dark">Order</b-badge>
            <b-badge v-if="data.value === 2" variant="success">Product</b-badge>
        </template>

        <template v-slot:cell(í_public)="data">
            <b-badge v-if="data.value === 1" variant="dark">Public</b-badge>
            <b-badge v-if="data.value === 2" variant="success">Private</b-badge>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0" variant="dark">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">On</b-badge>
            <b-badge v-if="data.value === 2" variant="danger">Off</b-badge>
        </template>

        <template v-slot:cell(max_use_time)="data">
            {{ getUseTime(data.value) }}
        </template>

        <template v-slot:cell(options)="data">
            <b-button-group>
                <b-button id="Delete" size="sm" variant="danger" class="mr-1 mdi mdi-trash-can" @click="deleteItem(data.item)"></b-button>
                <b-tooltip target="Delete" triggers="hover">Delete</b-tooltip>
            </b-button-group>
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'
import { mapState } from 'vuex'
import { buildURL } from '@/helpers/utils'
import axios from 'axios'

export default {
    name: 'UserPromotionList',
    mixins: [List],
    data() {
        return {
            showButton: false,
            value: 0,
            showDetailId: null,
            importRes: null,
            time: null,
            fields,
            displayFields: [
                'id',
                'user_id',
                'type',
                'code',
                'is_public',
                'product_id',
                'start_date',
                'end_date',
                'discount_value',
                'min_commission_fee',
                'modified_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                discount_value: '',
                is_public: '',
            },
            file: '',
            defaultSort: '-id',
            entry: 'crm/voucher'
        }
    },
    computed: {
        ...mapState({
            provinces: state => state.crm.provinces
        })
    },
    mounted() {
        this.getData()
    },
    methods: {
        getUseTime(time) {
            return 'Không giới hạn'
        },
        async deleteItem(item) {
            this.$confirm('Delete this order. Continue?', 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(async () => {
                item.deleted = 1
                // let entry = await this.$service.update(item.id, item)
                let entry = await this.$service.delete(item.id)
                if(entry) this.$message.success('✔ Deleted')
                this.getData()
            })
        },    
        provinceName(code) {
            let province = this.provinces.find(p => p.code == code)
            return province ? province.name : 'N/A'
        },
    }
}
</script>