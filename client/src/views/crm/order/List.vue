<template>
<page>
    <page-header>🚚 Orders</page-header>

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

        <template v-slot:cell(delivery_method)="data">
            <b-badge v-if="data.value === 0" variant="dark">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Giao hàng tiêu chuẩn</b-badge>
        </template>

        <template v-slot:cell(payment_method)="data">
            <b-badge v-if="data.value === 0" variant="dark">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Tiền mặt</b-badge>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0" variant="dark">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="warning">Chờ duyệt</b-badge>
            <b-badge v-if="data.value === 2" variant="info">Đang giao</b-badge>
            <b-badge v-if="data.value === 3" variant="success">Đã nhận</b-badge>
            <b-badge v-if="data.value === 4" variant="danger">Đã hủy</b-badge>
        </template>

        <template v-slot:cell(delivery_info)="data">
            <div style="width:250px"  v-html="getDeliveryInfo(data.value)"></div>
        </template>

        <template v-slot:cell(order_content)="data">
            <div style="width:500px" v-html="getOrderContent(data.value)"></div>
        </template>

        <template v-slot:cell(options)="data">
            <b-button-group>
                <b-button id="OrderEdit" :to="{name: 'OrderEdit', params: {id: data.item.id}}" size="sm" variant="warning" class="mdi mdi-circle-edit-outline"></b-button>
                <b-tooltip target="OrderEdit" triggers="hover">Edit</b-tooltip>
            </b-button-group>
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
    name: 'OrderList',
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
                'user_id',
                'discount',
                'promo_code',
                'shipping_fee',
                'bonus_fee',
                'grand_total',
                'delivery_method',
                'payment_method',
                'delivery_info',
                'order_content',
                'modified_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                discount: '',
                promo_code: '',
                grand_total: '',
                shipping_fee: '',
                bonus_fee: '',
                delivery_method: '',
                payment_method: '',
                order_code: '',
            },
            file: '',
            defaultSort: '-id',
            entry: 'crm/order'
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
        getDeliveryInfo(item) {
            var data = JSON.parse(item, true)
            return  `<p>
                    <strong>Full name:</strong>
                    ${data.name || 'No name'}
                </p>
                <p>
                    <strong>Phone:</strong> ${data.phone || 'No phone'}
                </p>
                <p>
                    <strong>Email:</strong> ${data.email || 'No email'}
                </p>
                <p>
                    <strong>Address:</strong>
                    ${data.address || 'No address'}
                </p>`
        },
        getOrderContent(item) {
            var data = JSON.parse(item, true)
            var html = '';
            data.forEach(function(a, index) {
                html +=`<h6>
                    <u style="color:red">Sản phẩm ${index + 1}</u>
                </h6>
                <p>
                    <strong>Tên sản phẩm:</strong>
                    ${a.name || 'No name'}
                </p>
                <p>
                    <strong>Số lượng:</strong> ${a.quantity || 'No quantity'}
                </p>
                <p>
                    <strong>Gía tiền:</strong> ${a.price || 'No price'}
                </p>
                <p>
                    <strong>Hoa hồng:</strong> ${a.commission || 'No commission'}
                </p>`;
            })
            return html
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