<template>
<div class="page-add">
    <h4 class="header py-3">Thêm mới</h4>
    <div class="bg-white p-3 shadow-sm">
        <b-form class="submit-form">
            <template v-for="(field, index) in addFields">
                <input-field :key="index" v-model="item[field.key]" :field="field"></input-field>
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

export default {
    name: 'AdminPackageAdd',
    mixins: [Add],
    data() {
        return {
            item: {},
            fields,
            entry: 'admin/packages'
        }
    },
    methods: {
        afterCreated(item) {
            if (item) {
                this.$bvToast.toast(item.name, {
                    title: 'Created',
                    variant: 'success'
                })
                this.$router.push({
                    name: 'AdminPackageEdit',
                    params: {
                        id: item.id
                    }
                })
            }
        }
    }
}
</script>