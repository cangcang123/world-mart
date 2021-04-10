<template>
<page>
    <page-header>👮 ⚠️ Admin Resources</page-header>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'AdminResourceAdd'}" class="float-right mdi mdi-plus" variant="primary" size="sm" slot="header-right">Thêm mới</b-button>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0" :items="items" :fields="tableFields"
        :busy="loading"
        show-empty striped hover responsive selectable @row-selected="_rowSelected">

        <template v-slot:cell(package_id)="data">
            {{ packageName(data.value) }}
        </template>

        <template v-slot:cell(is_publish)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="danger">Published</b-badge>
            <b-badge v-if="data.value === 2" variant="warning">Unpublished</b-badge>
        </template>

        <template v-slot:cell(options)="data">
            <b-button :to="{name: 'AdminResourceEdit', params: {id: data.item.id}}" size="sm" variant="outline-secondary" class="mdi mdi-information"></b-button>
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'
import { mapState } from 'vuex'

export default {
    name: 'AdminResourceList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: ['id', 'package_id', 'name', 'created_at'],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                package_id: undefined,
                name: '',
                is_publish: undefined,
                status: undefined,
            },
            entry: 'admin/resources'
        }
    },
    computed: {
        ...mapState({
            packages: state => state.admin.packages
        })
    },
    mounted() {
        this.getData()
    },
    methods: {
        packageName(value) {
            let pkg = this.packages.find(p => p.id == value)
            return pkg ? pkg.name.toUpperCase() : 'Loading...'
        },
    }
}
</script>
