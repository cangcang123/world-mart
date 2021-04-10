<template>
    <page class="page-add">
        <page-header>Edit Permission Role / Resource</page-header>

        <div class="bg-white p-3 shadow-sm" v-if="item">
            <b-form class="submit-form">
                <template v-for="(field, index) in editFields">
                    <input-field :key="index" v-model="item[field.key]" :field="field">
                        <b-form-select
                            v-model="item.resource"
                            :options="resources"
                            v-if="field.key === 'resource'"
                        ></b-form-select>

                        <b-form-checkbox
                            v-model="permissions.count"
                            switch
                            v-if="field.key === 'permissions'"
                        >Count</b-form-checkbox>

                        <b-form-checkbox
                            v-model="permissions.list"
                            switch
                            v-if="field.key === 'permissions'"
                        >List</b-form-checkbox>

                        <b-form-checkbox
                            v-model="permissions.create"
                            switch
                            v-if="field.key === 'permissions'"
                        >Create</b-form-checkbox>

                        <b-form-checkbox
                            v-model="permissions.detail"
                            switch
                            v-if="field.key === 'permissions'"
                        >Detail</b-form-checkbox>

                        <b-form-checkbox
                            v-model="permissions.update"
                            switch
                            v-if="field.key === 'permissions'"
                        >Update</b-form-checkbox>

                        <b-form-checkbox
                            v-model="permissions.delete"
                            switch
                            v-if="field.key === 'permissions'"
                        >Delete</b-form-checkbox>

                        <b-form-checkbox
                            v-model="permissions.import"
                            switch
                            v-if="field.key === 'permissions'"
                        >Import</b-form-checkbox>

                        <b-form-checkbox
                            v-model="permissions.export"
                            switch
                            v-if="field.key === 'permissions'"
                        >Export</b-form-checkbox>
                    </input-field>
                </template>
            </b-form>
            <b-form-group class="submit-form">
                <b-button type="submit" @click.prevent="save" variant="primary">Save</b-button>
                <b-button :to="{name: 'PermissionRoleList'}" class="mdi mdi-arrow-left">Back</b-button>
            </b-form-group>
        </div>
    </page>
</template>

<script>
import fields from './fields'
import Edit from '@/mixins/edit'
import CURD from '@/services/curd'

export default {
    name: 'PermissionRoleEdit',
    mixins: [Edit],
    data() {
        return {
            fields,
            packages: [],
            roles: [],
            resources: [],
            permissions: {
                count: true,
                list: true,
                create: true,
                detail: true,
                update: true,
                delete: false,
                import: false,
                export: false
            },
            displayFields: ['resource', 'permissions' , 'is_publish', 'state', 'status'],
            entry: 'admin/permission-role'
        }
    },
    mounted() {
        this.getData()
        this.getResources()
    },
    methods: {
        afterGotData(item) {
            if (!item.permissions) {
                item.permissions  = {
                    count: true,
                    list: true,
                    create: true,
                    detail: true,
                    update: true,
                    delete: false,
                    import: false,
                    export: false
                }
            } else {
                item.permissions = JSON.parse(item.permissions)
                this.permissions = item.permissions
            }
        },
        beforeSave() {
            this.item.permissions = JSON.stringify(this.permissions);
        },
        afterSave(item) {
            this.getData()
        },
        async getPackages() {
            let service = new CURD('admin/packages')
            let entries = (await service.list()).entries || []
            this.packages = entries.map(e => ({ value: e.id, text: e.name }))
        },
        async getRoles() {
            let service = new CURD('admin/roles')
            let entries = (await service.list()).entries || []
            this.roles = entries.map(e => ({ value: e.id, text: e.name }))
        },
        async getResources() {
            let service = new CURD('admin/resources')
            let entries = (await service.list({limit: 100})).entries || []
            this.resources = entries.map(e => ({ value: e.name, text: e.name }))
        }
    },
    watch: {
    }
}
</script>