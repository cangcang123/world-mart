<template>
<page class="page-add">
    <page-header>Edit Resource</page-header>

    <div class="bg-white p-3 shadow-sm" v-if="item">
        <b-form class="submit-form">
            <template v-for="(field, index) in editFields">
                <input-field :key="index" v-model="item[field.key]" :field="field">
                    <b-form-select v-model="item.package_id" :options="packages" v-if="field.key === 'package_id'"></b-form-select>
                </input-field>
            </template>
        </b-form>
        <b-form-group class="submit-form">
            <b-button type="submit" @click.prevent="save" variant="primary">Save</b-button>
            <b-button :to="{name: 'AdminResourceList'}" class="mdi mdi-arrow-left">Back</b-button>
    </b-form-group>
    </div>
</page>
</template>

<script>
import fields from './fields'
import Edit from '@/mixins/edit'
import CURD from '@/services/curd'

export default {
    name: 'AdminResourceEdit',
    mixins: [Edit],
    data() {
        return {
            fields,
            packages: [],
            displayFields: ['package_id', 'name', 'is_publish', 'state', 'status'],
            entry: 'admin/resources'
        }
    },
    mounted() {
        this.getData()
        this.getPackages()
    },
    methods: {
        afterGotData(item) {
        },
        async getPackages() {
            let packageService = new CURD('admin/packages')
            let entries = (await packageService.list()).entries || []
            this.packages = entries.map(e => ({ value: e.id, text: e.name }))
        }
    }
}
</script>