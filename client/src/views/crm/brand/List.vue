<template>
<page>
    <page-header>🅱️ Brands</page-header>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'BrandAdd'}" class=" mdi mdi-plus mb-3 float-right" variant="success" size="sm" slot="header-right">Add Brand</b-button>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0"
        :items="items"
        :fields="tableFields"
        :busy="loading"
        bordered
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
            <b-badge v-if="data.value === 1" variant="success">On</b-badge>
            <b-badge v-else-if="data.value === 2" variant="danger">Off</b-badge>
            <b-badge v-else variant="dark">Undefined</b-badge>
        </template>

        <template v-slot:cell(description)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(distributor)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(country)="data">
            <p>{{ getCountry(data.value) || 'N/A' }}</p>
        </template>

        <template v-slot:cell(logo)="data">
            <div class="text-center" >
                <b-img thumbnail :src="data.value || 'https://via.placeholder.com/210x140?text=Thumbnail Article'" width=100 ></b-img>
            </div>
        </template>

        <template v-slot:cell(options)="data">
            <b-button id="Active" size="sm" variant="success" class="mr-1 mdi mdi-thumb-up-outline" @click="onActive(data.item)"></b-button>
            <b-tooltip target="Active" triggers="hover">Active</b-tooltip>

            <b-button id="InActive" size="sm" variant="danger" class="mr-1 mdi mdi-thumb-down-outline" @click="onInactive(data.item)"></b-button>
            <b-tooltip target="InActive" triggers="hover">InActive</b-tooltip>
            <b-button-group>
                <b-button id="BrandEdit" :to="{name: 'BrandEdit', params: {id: data.item.id}}" size="sm" variant="warning" class="mdi mdi-circle-edit-outline"></b-button>
                <b-tooltip target="BrandEdit" triggers="hover">Edit</b-tooltip>
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
    name: 'BrandList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: [
                'id',
                'name',
                'logo',
                'description',
                'distributor',
                'country',
                'status',
                'modified_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                distributor: '',
                country: undefined,
                status: undefined
            },
            file: '',
            defaultSort: '-id',
            entry: 'crm/brand'
        }
    },
    computed: {
        ...mapState({
            countries: state => state.crm.countries
        })
    },
    mounted() {
        this.getData()
    },
    methods: {
        getCountry(code) {
            let country = this.countries.find(p => p.iso == code)
            return country ? country.country_name : 'N/A'
        },
        async onActive(item) {
            item.status = 1
            let entry = await this.$service.update(item.id, item)
            if(entry) this.$message.success('✔ Approved')
        },

        async onInactive(item) {
            item.status = 2
            let entry = await this.$service.update(item.id, item)
            if(entry) this.$message.warning('❌ Rejected')
        },
    }
}
</script>