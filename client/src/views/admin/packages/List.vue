<template>
<page>
    <page-header>Admin Packages</page-header>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'AdminPackageAdd'}" class="float-right mdi mdi-plus" variant="primary" size="sm" slot="header-right">Thêm mới</b-button>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0" :items="items" :fields="tableFields"
        :busy="loading"
        show-empty striped hover responsive selectable @row-selected="_rowSelected">
        <template v-slot:cell(options)="data">
            <b-button :to="{name: 'AdminPackageEdit', params: {id: data.item.id}}" size="sm" variant="outline-secondary" class="mdi mdi-information"></b-button>
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'

export default {
    name: 'AdminPackageList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: ['id', 'name', 'created_at'],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: ''
            },
            entry: 'admin/packages'
        }
    },
    mounted() {
        this.getData()
    }
}
</script>
