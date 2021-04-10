<template>
<page>
    <page-header>🏛️ 👮‍♂️ Admin Users</page-header>

    <action-bar @change="onFilterChanged">
        <b-button :to="{ name: 'AdminUserAdd' }" class="float-right mdi mdi-plus" variant="primary" size="sm" slot="header-right">New User</b-button>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0" :items="items" :fields="tableFields"
        :busy="loading"
        show-empty striped hover responsive selectable @row-selected="_rowSelected">

        <template v-slot:cell(username)="data">
            <vs-chip color="success">
                <vs-avatar :text="data.value"/>
                {{ data.value }}
            </vs-chip>
        </template>

        <template v-slot:cell(role_id)="data">
            {{ roleName(data.value) }}
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Active</b-badge>
            <b-badge v-if="data.value === 2" variant="warning">Inactive</b-badge>
        </template>

        <template v-if="role_id === 1" v-slot:cell(locked)="data">
            <vs-switch v-if="data.item.id != 1" color="danger" v-model="data.item.locked" @change.native="updateLockedUser(data.item.id, data.item.locked)">
                <span slot="on">Yes</span>
                <span slot="off">No</span>
            </vs-switch>
        </template>

        <template v-slot:cell(options)="data">
            <vs-button :to="{name: 'AdminUserEdit', params: {id: data.item.id}}" type="filled" size="small" icon="info"></vs-button>
            <!-- <b-button :to="{name: 'AdminUserEdit', params: {id: data.item.id}}" size="sm" variant="outline-secondary" class="mdi mdi-information"></b-button> -->
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'
import { mapState } from 'vuex'
import CURD from '@/services/curd'

export default {
    name: 'AdminUserList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: ['id', 'username', 'full_name', 'modified_at'],
            appendColumns: [
                'locked',
                'options'
            ],
            defaultFilter: {
                username: '',
                full_name: '',
                role_id: undefined,
                status: undefined,
            },
            entry: 'admin/users',
        }
    },
    computed: {
        ...mapState({
            roles: state => state.admin.roles,
            role_id: state => state.auth.user.role_id || 0
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
        async updateLockedUser(user_id, locked) {
            let userService = new CURD('admin/users')
            let entries = await userService.update(user_id, {locked: locked}).catch(err=>{
                this.$message.error('Update error!')
            })
            if (entries) {
                if (locked == true) {
                    this.$notify({
                        title: 'Locked',
                        message: `${entries.full_name} (${entries.username}) locked`,
                        type: 'warning',
                        offset: 100
                    });
                } else {
                    this.$notify({
                        title: 'Unlock',
                        message: `${entries.full_name} (${entries.username}) unlock`,
                        type: 'warning',
                        offset: 100
                    })
                }
            }
            return true
        }
    }
}
</script>
