

<template>
    <page>
        <page-header header="📰 SKUs List">
        </page-header>

        <action-bar hide-columns @change="onFilterChanged" />

        <div class="mb-2">
            <span v-if="loading">Đang tải...</span
            ><span v-else>Tổng {{ pagination.total }}</span>
        </div>

        <page-body class="shadow rounded">
            <b-table
                :items="items"
                :fields="tableFields"
                :busy="loading"
                show-empty
                striped
                hover
                responsive
                selectable
                no-local-sorting
                select-mode="single"
                @sort-changed="onSortChanged"
                @row-selected="_rowSelected"
            >
                <template v-slot:table-busy>
                    <div class="text-center my-2">
                        <b-spinner
                            class="align-middle"
                            small
                            variant="warning"
                            type="grow"
                        ></b-spinner>
                        <b-spinner
                            class="align-middle"
                            small
                            variant="success"
                            type="grow"
                        ></b-spinner>
                        <b-spinner
                            class="align-middle"
                            small
                            variant="info"
                            type="grow"
                        ></b-spinner>
                    </div>
                </template>
                <template v-slot:cell(product_id)="data">
                    <p >{{ getProduct(data.item.product_id) || product_name }}</p>
                </template>
                <template v-slot:cell(status)="data">
                    <b-badge v-if="data.value === 1" variant="success">Active</b-badge>
                    <b-badge v-else-if="data.value === 2" variant="danger">Deactivated</b-badge>
                    <b-badge v-else variant="dark">Undefined</b-badge>
                </template>

                <!-- <template v-slot:cell(thumbnail)="data">
                    <img width="200" :src="data.item.thumbnail"/>
                </template> -->

                <template v-slot:cell(size)="data">
                    <p>{{ data.value || 'N/A' }}</p>
                </template>

                <template v-slot:cell(color)="data">
                    <p>{{ data.value || 'N/A' }}</p>
                </template>

                <template v-slot:cell(weight)="data">
                    <p>{{ data.value || 'N/A' }}</p>
                </template>

                <template v-slot:cell(memory)="data">
                    <p>{{ data.value || 'N/A' }}</p>
                </template>

                <template v-slot:cell(thumbnail)="data">
                    <div class="text-center" >
                        <b-img thumbnail :src="data.value || 'https://via.placeholder.com/210x140?text=Thumbnail Article'" width=100 ></b-img>
                    </div>
                </template>
                <template v-slot:cell(options)="data">
                    <b-button-group>
                        <b-button
                            :to="{
                                name: 'SkusEdit',
                                params: { id: data.item.id },
                            }"
                            size="sm"
                            variant="danger"
                            class="mdi mdi-pen"
                            v-b-tooltip.hover
                            title="Cập nhật Sku"
                        ></b-button>
                    </b-button-group>
                </template>
            </b-table>
        </page-body>

        <pagination />
    </page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'
import { mapState } from 'vuex'
import { buildURL } from '@/helpers/utils'
import axios from 'axios'
import store from '@/store'
import CURD from '@/services/curd'
const productService = new CURD('crm/product')

export default {
    name: 'SkusList',
    mixins: [List],
    data: () => ({
        fields,
        defaultSort: '-id',
        appendColumns: ['options'],
        displayFields: [
            'id',
            'name',
            'description',
            'status',
        ],
        defaultFilter: {
            name: '',
        },
        product_name: 'N/A',
        entry: 'crm/skus',
    }),
    computed: {
    },
    mounted() {
        this
    },
    mounted() {
        this.getData()
    },
    methods: {
        getProduct(id) {
            setTimeout(async () => {
                var prod = (await productService.list({filter: {id: id}})).entries
                this.product_name = prod[0].name
            }, 100);
        },
    },
}
</script>
