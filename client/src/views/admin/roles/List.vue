<template>
<page>
    <page-header>👮 ⚠️ Admin Roles</page-header>

    <div class="mb-4">
        <b-row>
            <b-col>
                <router-link :to="{name: 'PermissionRoleList'}">
                    <el-button icon="el-icon-edit" type="warning" size="small" plain>Permission</el-button>
                </router-link>
            </b-col>
        </b-row>
    </div>

    <action-bar @change="onFilterChanged">
        <b-button to="/admin/roles/add" class="float-right mdi mdi-plus" variant="primary" size="sm" slot="header-right">Thêm mới</b-button>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0" :items="items" :fields="tableFields"
        :busy="loading"
        show-empty striped hover responsive selectable @row-selected="_rowSelected">

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Active</b-badge>
            <b-badge v-if="data.value === 2" variant="warning">Inactive</b-badge>
        </template>

        <template v-slot:cell(options)="data">
            <b-button :to="{name: 'AdminRoleEdit', params: {id: data.item.id}}" size="sm" variant="outline-secondary" class="mdi mdi-information"></b-button>
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'

export default {
    name: 'AdminRoleList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: ['id', 'name', 'description', 'created_at'],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                description: '',
                status: undefined,
            },
            entry: 'admin/roles'
        }
    },
    mounted() {
        this.getData()
    }
}
</script>
