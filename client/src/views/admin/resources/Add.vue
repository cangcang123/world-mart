<template>
<div class="page-add">
    <h4 class="header py-3">Thêm mới</h4>
    <div class="bg-white p-3 shadow-sm">
        <b-form class="submit-form">
            <template v-for="(field, index) in addFields">
                <input-field :key="index" v-model="item[field.key]" :field="field">
                    <b-form-select v-model="item.package_id" :options="packages" v-if="field.key === 'package_id'"></b-form-select>
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
    name: 'AdminResourceAdd',
    mixins: [Add],
    data() {
        return {
            item: {},
            fields,
            packages: [],
            entry: 'admin/resources'
        }
    },
    mounted() {
        this.getPackages()
    },
    methods: {
        afterCreated(item) {
            if (item) {
                this.$bvToast.toast(item.name, {
                    title: 'Created',
                    variant: 'success'
                })
                this.$router.push({
                    name: 'AdminResourceEdit',
                    params: {
                        id: item.id
                    }
                })
            }
        },
        async getPackages() {
            let packageService = new CURD('admin/packages')
            let entries = (await packageService.list()).entries || []
            this.packages = entries.map(e => ({ value: e.id, text: e.name }))
        }
    }
}
</script>