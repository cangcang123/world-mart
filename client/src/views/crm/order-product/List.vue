<template>
<page>
    <page-header>🗳 Order Products</page-header>

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

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0" variant="dark">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Completed</b-badge>
        </template>

        <template v-slot:cell(cover_photo)="data">
            <b-img v-if="data.value" thumbnail fluid :src="data.value" width="100"></b-img>
            <p v-else> N/A </p>
        </template>

        <template v-slot:cell(options)="data">
            <b-button-group>
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
    name: 'OrderProductList',
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
                'name',
                'cover_photo',
                'order_id',
                'user_id',
                'product_id',
                'product_name',
                'quantity',
                'price',
                'commission',
                'modified_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                order_id: '',
                user_id: '',
                order_code: '',
                product_id: '',
                product_name: '',
                quantity: '',
                price: '',
                // brand: '',
                // origin: '',
                // category: '',
            },
            file: '',
            defaultSort: '-id',
            entry: 'crm/order-product'
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
        provinceName(code) {
            let province = this.provinces.find(p => p.code == code)
            return province ? province.name : 'N/A'
        },
    }
}
</script>