<template>
<div class="page-add">
    <h4 class="header py-3">Chỉnh sửa</h4>
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
</div>
</template>

<script>
import fields from './fields'
import Edit from '@/mixins/edit'

export default {
    name: 'CRMConfigEdit',
    mixins: [Edit],
    data() {
        return {
            fields,
            displayFields: ['status', 'value', 'name', 'description', 'key'],
            entry: 'crm/configs'
        }
    },
    mounted() {
        this.getData()
    }
}
</script>