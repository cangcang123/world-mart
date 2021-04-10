<template>
<page class="page-add">
    <page-header>Edit user profile
        <b-button :to="{name: 'AdminUserEditPass', params: { id }}" size="sm" slot="actions">Reset Password</b-button>
    </page-header>

    <div class="bg-white p-3 shadow-sm" v-if="item">
        <b-form class="submit-form">
            <template v-for="(field, index) in editFields">
                <input-field :key="index" v-model="item[field.key]" :field="field">
                    <b-form-select v-model="item.role_id" :options="roles" v-if="field.key === 'role_id'"></b-form-select>
                </input-field>
            </template>
        </b-form>
        <b-form-group class="submit-form">
            <b-button type="submit" @click.prevent="save" variant="primary">Save</b-button>
            <b-button @click="$router.back()" class="mdi mdi-arrow-left">Back</b-button>
        </b-form-group>
    </div>
</page>
</template>

<script>
import fields from './fields'
import Edit from '@/mixins/edit'
import CURD from '@/services/curd'

export default {
    name: 'AdminUserEdit',
    mixins: [Edit],
    data() {
        return {
            roles: [],
            fields,
            displayFields: ['username', 'full_name', 'avatar', 'email', 'phone', 'dob', 'gender', 'role_id', 'status'],
            entry: 'admin/users'
        }
    },
    mounted() {
        this.getData()
        this.getRoles()
    },
    methods: {
        afterGotData(item) {
        },
        async getRoles() {
            let roleService = new CURD('admin/roles')
            let entries = (await roleService.list()).entries || []
            this.roles = entries.map(e => ({ value: e.id, text: e.name }))
        }
    }
}
</script>