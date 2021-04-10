<template>
<page>
    <page-header>️💼 Categories</page-header>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'CategoryAdd'}" class=" mdi mdi-plus mb-3 float-right" variant="success" size="sm" slot="header-right">Add Category</b-button>
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

        <template v-slot:cell(parent_id)="data">
            <p>{{ getCate(data.value) || 'N/A' }}</p>
        </template>

        <template v-slot:cell(description)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(country)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(meta_title)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(image_url)="data">
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
                <b-button id="CategoryEdit" :to="{name: 'CategoryEdit', params: {id: data.item.id}}" size="sm" variant="warning" class="mdi mdi-circle-edit-outline"></b-button>
                <b-tooltip target="CategoryEdit" triggers="hover">Edit</b-tooltip>
            </b-button-group>
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import store from '@/store'
import fields from './fields'
import { mapState } from 'vuex'
import { buildURL } from '@/helpers/utils'
import axios from 'axios'

export default {
    name: 'CategoryList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: [
                'id',
                'name',
                'image_url',
                'parent_id',
                'description',
                'status',
                'created_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                status: undefined
            },
            file: '',
            defaultSort: '-id',
            entry: 'crm/category'
        }
    },
    computed: {
    },
    mounted() {
        this.getData()
        this.getCates()
    },
    methods: {
        getCate(id) {
            if (store.state.crm.category.length > 0) {
                let res = store.state.crm.category.find(f => {
                    return f.id == id
                })
                return res ? res.name : id
            }
            return id
        },
        async getCates() {
            if (!store.state.crm.category.length) {
                await store.dispatch('crm/getCategories')
            }
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