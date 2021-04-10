<template>
<div class="page-add">
    <h4 class="header py-3">Chỉnh sửa</h4>
    <div class="bg-white p-3 shadow-sm" v-if="item">
        <b-form class="submit-form">
            <template v-for="(field, index) in editFields">
                <input-field :key="index" v-model="item[field.key]" :field="field">
                </input-field>
            </template>
        </b-form>
        <b-form-group class="submit-form">
            <b-button type="submit" @click.prevent="save" variant="primary">Save</b-button>
            <b-button @click="$router.back()" class="mdi mdi-arrow-left">Back</b-button>
            <b-button @click="requestDelete" variant="danger" class="float-right mdi mdi-delete-variant">Delete</b-button>
        </b-form-group>
    </div>
</div>
</template>

<script>
import fields from './fields'
import Edit from '@/mixins/edit'

export default {
    name: 'UserTagEdit',
    mixins: [Edit],
    data() {
        return {
            fields,
            displayFields: [
                'name',
                'description',
                'status'
            ],
            entry: 'crm/user-tag'
        }
    },
    mounted() {
        this.getData()
    },
}
</script>