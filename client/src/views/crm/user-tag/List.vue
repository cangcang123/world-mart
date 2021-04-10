<template>
<page>
    <page-header>🏷️ User Tags (Customer & Follower)</page-header>

    <customer-menu></customer-menu>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'UserTagAdd'}" class="float-right mdi mdi-plus" variant="primary" size="sm" slot="header-right">New User Tag</b-button>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0" :items="items" :fields="tableFields" :busy="loading"
        show-empty striped hover responsive selectable @row-selected="_rowSelected">

        <template v-slot:cell(name)="data">
            <router-link :to="{name: 'UserTagEdit', params: {id: data.item.id}}">
                <vs-chip :color="hashCode(data.value)" size=""><vs-avatar :text="data.value"/>{{ data.value }}</vs-chip>
            </router-link>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 0">Undefined</b-badge>
            <b-badge v-if="data.value === 1" variant="success">Active</b-badge>
            <b-badge v-if="data.value === 2" variant="warning">Inactive</b-badge>
        </template>

        <template v-slot:cell(options)="data">
            <b-button :to="{name: 'UserTagEdit', params: {id: data.item.id}}" size="sm" variant="outline-secondary" class="mdi mdi-information"></b-button>
        </template>
    </b-table>
    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'

export default {
    name: 'UserTagList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: ['name', 'description', 'status', 'modified_at'],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                description: '',
                status: undefined
            },
            defaultSort: '-id',
            entry: 'crm/user-tag'
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        hashCode(str) {
            var hash = 0;
            for (var i = 0; i < str.length; i++) {
                hash = str.charCodeAt(i) + ((hash << 5) - hash);
            }
            var colour = '#';
            for (var i = 0; i < 3; i++) {
                var value = (hash >> (i * 8)) & 0xFF;
                value = Math.min(value, 384 - value)
                colour += ('00' + value.toString(16)).substr(-2);
            }
            return colour;
        },
    },
}
</script>
