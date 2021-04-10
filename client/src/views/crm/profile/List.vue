<template>
<page>
    <page-header>👥 User Profiles / Customers</page-header>

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

        <template v-slot:cell(gender)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Male</b-badge>
            <b-badge v-if="data.value === 2" variant="warning">Female</b-badge>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0" variant="dark">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">On</b-badge>
            <b-badge v-if="data.value === 2" variant="danger">Off</b-badge>
        </template>

        <template v-slot:cell(identification)="data">
            <div style="width:250px"  v-html="getIdentity(data.value)"></div>
        </template>

        <template v-slot:cell(banking_info)="data">
            <div style="width:250px" v-html="getBankInfo(data.value)"></div>
        </template>

        <template v-slot:cell(options)="data">
            <b-button-group>
                <b-button
                    @click="showDetailModal(data.item.id)"
                    size="sm"
                    variant="info"
                    class="mdi mdi-account-box"
                    v-b-tooltip.hover title="Profile Information"
                ></b-button>
            </b-button-group>
        </template>
    </b-table>
    <detail-modal :id.sync="showDetailId"></detail-modal>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'
import { mapState } from 'vuex'
import DetailModal from './Detail'
import { buildURL } from '@/helpers/utils'
import axios from 'axios'

export default {
    name: 'UserProfileList',
    mixins: [List],
    components: {
        DetailModal,
    },
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
                'full_name',
                'phone',
                'gender',
                'province',
                'modified_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                phone: '',
                full_name: '',
            },
            file: '',
            defaultSort: '-id',
            entry: 'crm/user-profile'
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

        showDetailModal(profile_id) {
            this.showDetailId = profile_id
        },

        getIdentity(item) {
            if (item) {
                var data = JSON.parse(item, true)
                return  `<p>
                        <strong>Full name:</strong>
                        ${data.full_name || 'No name'}
                    </p>
                    <p>
                        <strong>CMND:</strong> ${data.id_number || 'N/A'}
                    </p>
                    <p>
                        <strong>Ngày cấp:</strong> ${data.date || 'N/A'}
                    </p>
                    <p>
                        <strong>Nơi cấp:</strong>
                        ${data.address || 'No address'}
                    </p>`
            }
            return 'N/A'
        },

        getBankInfo(item) {
            if (item) {
                var data = JSON.parse(item, true)
                return  `<p>
                        <strong>Tên ngân hàng:</strong>
                        ${data.bank_name || 'N/A'}
                    </p>
                    <p>
                        <strong>Chi nhánh:</strong> ${data.address || 'No address'}
                    </p>
                    <p>
                        <strong>Tên chủ tài khoản:</strong> ${data.full_name || 'No name'}
                    </p>
                    <p>
                        <strong>Số tài khoản:</strong>
                        ${data.number || 'N/A'}
                    </p>`
            }
            return 'N/A'
        },
    }
}
</script>