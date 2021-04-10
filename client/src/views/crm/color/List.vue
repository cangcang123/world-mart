<template>
<page>
    <page-header>️🎨 Colors</page-header>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'ColorAdd'}" class=" mdi mdi-plus mb-3 float-right" variant="success" size="sm" slot="header-right">Add Color</b-button>
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

        <template v-slot:cell(gender)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Male</b-badge>
            <b-badge v-if="data.value === 2" variant="warning">Female</b-badge>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 1" variant="success">On</b-badge>
            <b-badge v-else-if="data.value === 2" variant="danger">Off</b-badge>
            <b-badge v-else variant="dark">Undefined</b-badge>
        </template>

        <template v-slot:cell(color_code)="data">
            <div class="square" :style="getColor(data.value)"></div>
        </template>

        <template v-slot:cell(description)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(options)="data">
            <b-button id="Active" size="sm" variant="success" class="mr-1 mdi mdi-thumb-up-outline" @click="onActive(data.item)"></b-button>
            <b-tooltip target="Active" triggers="hover">Active</b-tooltip>

            <b-button id="InActive" size="sm" variant="danger" class="mr-1 mdi mdi-thumb-down-outline" @click="onInactive(data.item)"></b-button>
            <b-tooltip target="InActive" triggers="hover">InActive</b-tooltip>
            <b-button-group>
                <b-button id="ColorEdit" :to="{name: 'ColorEdit', params: {id: data.item.id}}" size="sm" variant="warning" class="mdi mdi-circle-edit-outline"></b-button>
                <b-tooltip target="ColorEdit" triggers="hover">Edit</b-tooltip>
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
    name: 'ColorList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: [
                'id',
                'name',
                'color_code',
                'description',
                'status',
                'modified_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
            },
            file: '',
            defaultSort: '-id',
            entry: 'crm/color'
        }
    },
    computed: {
    },
    mounted() {
        this.getData()
    },
    methods: {
        getColor(color_code) {
            return 'background-color:'+color_code
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
<style >
    .square {
        height: 25px;
        width: 25px;
        border-radius: 50%
    }
</style>