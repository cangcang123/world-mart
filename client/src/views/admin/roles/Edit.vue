<template>
<page class="page-add">
    <page-header>Edit Role</page-header>

    <div class="bg-white p-3 shadow-sm" v-if="item">
        <b-form class="submit-form">
            <template v-for="(field, index) in editFields">
                <input-field :key="index" v-model="item[field.key]" :field="field"></input-field>
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

export default {
    name: 'AdminRoleEdit',
    mixins: [Edit],
    data() {
        return {
            fields,
            displayFields: ['name', 'description', 'status'],
            entry: 'admin/roles'
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        afterGotData(item) {
        }
    }
}
</script>