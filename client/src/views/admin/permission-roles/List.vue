<template>
<page>
    <page-header>👮 ⚠️ Admin Permission Roles</page-header>

    <div class="mb-4">
        <b-row>
            <b-col>
                <router-link :to="{name: 'AdminRoleList'}">
                    <el-button icon="el-icon-arrow-left" type="info" size="small" plain>Back to Role</el-button>
                </router-link>
            </b-col>
        </b-row>
    </div>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'PermissionRoleAdd'}" class="float-right mdi mdi-plus" variant="primary" size="sm" slot="header-right">Thêm mới</b-button>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0"
        :items="items"
        :fields="tableFields"
        :busy="loading"
        show-empty striped hover responsive selectable
        @row-selected="_rowSelected">

        <template v-slot:table-busy>
            <div class="text-center my-2">
                <b-spinner class="align-middle" small variant="warning" type="grow"></b-spinner>
                <b-spinner class="align-middle" small variant="success" type="grow"></b-spinner>
                <b-spinner class="align-middle" small variant="info" type="grow"></b-spinner>
            </div>
        </template>

        <template v-slot:cell(role_id)="data">
            {{ roleName(data.value) }}
        </template>

        <template v-slot:cell(resource)="data">
            {{ resourceName(data.value) }}
        </template>

        <template v-slot:cell(permissions)="data">
            <b-form-group>
                <b-form-checkbox-group
                    :id="data.item.resource"
                    v-model="selected"
                    :options="formartDataPermission(data.item.permissions)"
                ></b-form-checkbox-group>
            </b-form-group>
        </template>

        <template v-slot:cell(is_publish)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="danger">Published</b-badge>
            <b-badge v-if="data.value === 2" variant="warning">Unpublished</b-badge>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Active</b-badge>
            <b-badge v-if="data.value === 2" variant="primary">Inactive</b-badge>
        </template>

        <template v-slot:cell(options)="data">
            <b-button :to="{name: 'PermissionRoleEdit', params: {id: data.item.id}}" size="sm" variant="outline-secondary" class="mdi mdi-information"></b-button>
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
    name: 'PermissionRoleList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: ['resource', 'permissions', 'modified_at'],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                role_id: '',
                resource: '',
                is_publish: undefined,
                status: undefined,
            },
            selected: [true],
            entry: 'admin/permission-role'
        }
    },
    computed: {
        ...mapState({
            roles: state => state.admin.roles
        })
    },
    mounted() {
        this.getData()
    },
    methods: {
        roleName(value) {
            let role = this.roles.find(p => p.id == value)
            return role ? role.name : 'Loading...'
        },
        resourceName(string) {
            string = string.replace(/_/g, ' ');
            // return string.charAt(0).toUpperCase() + string.slice(1)
            string = string.split(" ")
            for (var i = 0, x = string.length; i < x; i++) {
                string[i] = string[i][0].toUpperCase() + string[i].substr(1)
            }
            return string.join(" ")
        },
        formartDataPermission(permissions) {
            let list = []
            if (permissions) {
                permissions = JSON.parse(permissions)
                Object.entries(permissions).forEach(([key, val]) => {
                    list.push({
                        text: key.charAt(0).toUpperCase() + key.substring(1), value: val, disabled: true
                    })
                })
            }
            return list
        }
    }
}
</script>
