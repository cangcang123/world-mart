<template>
<div class="page-add">
    <h4 class="header py-3">Thêm mới</h4>
    <div class="bg-white p-3 shadow-sm">
        <b-form class="submit-form">
            <template v-for="(field, index) in addFields">
                <input-field :key="index" v-model="item[field.key]" :field="field">
                    <b-form-select v-model="item.role_id" :options="roles" v-if="field.key === 'role_id'"></b-form-select>
                </input-field>
            </template>
        </b-form>
        <b-form-group class="submit-form">
            <b-button type="submit" @click.prevent="create" variant="primary">Submit</b-button>
            <b-button @click="$router.back()" class="mdi mdi-arrow-left"> Back</b-button>
        </b-form-group>
    </div>
</div>
</template>

<script>
import fields from './fields'
import Add from '@/mixins/add'
import CURD from '@/services/curd'

export default {
    name: 'AdminUserAdd',
    mixins: [Add],
    data() {
        return {
            item: {
                status: 1
            },
            fields,
            roles: [],
            entry: 'admin/users'
        }
    },
    mounted() {
        this.getRoles()
    },
    methods: {
        afterCreated(item) {
            if (item) {
                this.$bvToast.toast(item.name, {
                    title: 'Created',
                    variant: 'success'
                })
                this.$router.push({
                    name: 'AdminUserEdit',
                    params: {
                        id: item.id
                    }
                })
            }
        },
        async getRoles() {
            let roleService = new CURD('admin/roles')
            let entries = (await roleService.list()).entries || []
            this.roles = entries.map(e => ({ value: e.id, text: e.name }))
        }
    }
}
</script>