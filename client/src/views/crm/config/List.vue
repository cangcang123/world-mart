<template>
<page>
    <page-header>CRM Configs</page-header>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'CRMConfigAdd'}" class="float-right mdi mdi-plus" variant="primary" size="sm" slot="header-right">Thêm mới</b-button>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0" :items="items" :fields="tableFields" :busy="loading"
        show-empty striped hover responsive selectable @row-selected="_rowSelected">

        <template v-slot:cell(value)="data">
            <b-badge v-if="data.value === '0'" variant="dark">Undefined</b-badge>
            <b-badge v-else-if="data.value === '1'" variant="info">Active</b-badge>
            <b-badge v-else-if="data.value === '2'" variant="danger">Inactive</b-badge>
            <b-badge v-else>{{ data.value }}</b-badge>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Active</b-badge>
            <b-badge v-if="data.value === 2" variant="warning">Inactive</b-badge>
        </template>

        <template v-slot:cell(options)="data">
            <b-button :to="{name: 'CRMConfigEdit', params: {id: data.item.id}}" size="sm" variant="outline-secondary" class="mdi mdi-information"></b-button>
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'

export default {
    name: 'CRMConfigList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: ['name', 'key', 'value', 'modified_at'],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                key: '',
                value: ''
            },
            entry: 'crm/configs'
        }
    },
    mounted() {
        this.getData()
    }
}
</script>
