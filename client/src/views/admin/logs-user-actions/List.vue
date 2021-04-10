<template>
<page>
    <page-header>Logs User Action</page-header>

    <action-bar @change="onFilterChanged">
        <div class="float-right"  slot="header-right">
            <el-button icon="el-icon-download" type="success" size="small" @click="exportExcel('custom', time)">Export</el-button>
            <el-tooltip class="item" effect="dark" content="Choose date range to export" placement="top">
                    <date-range size="sm" class="d-inline-block ml-2" :time.sync="time"></date-range>
            </el-tooltip>
        </div>
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0"
        :items="items"
        :fields="tableFields"
        :busy="loading"
        show-empty striped hover responsive selectable
        @row-selected="_rowSelected">

        <template v-slot:table-busy>
            <div class="text-center my-2">
                <b-spinner class="align-middle" small variant="warning" type="grow"></b-spinner>
                <b-spinner class="align-middle" small variant="success" type="grow"></b-spinner>
                <b-spinner class="align-middle" small variant="info" type="grow"></b-spinner>
            </div>
        </template>

        <template v-slot:cell(role_id)="data">
            {{ roleName(data.value) }}
        </template>

        <template v-slot:cell(resource)="data">
            {{ resourceName(data.value) }}
        </template>

        <template v-slot:cell(permissions)="data">
            <b-form-group>
                <b-form-checkbox-group
                    :id="data.item.resource"
                    v-model="selected"
                    :options="formartDataPermission(data.item.permissions)"
                ></b-form-checkbox-group>
            </b-form-group>
        </template>
    </b-table>

    <count-down :leftTime="leftime" link="log-export" :modalShow.sync="modalShow"/>
    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'
import { mapState } from 'vuex'
import CountDown from './modals/CountDown'

export default {
    name: 'LogsUserActionList',
    mixins: [List],
    components: {
        CountDown
    },
    data() {
        return {
            modalShow: false,
            leftime: 5000,
            fields,
            time: null,
            displayFields: ['role_id', 'username', 'resource', 'action', 'ip', 'created_at'],
            appendColumns: [],
            defaultFilter: {
                role_id: '',
                resource: '',
                action: '',
                ip: '',
            },
            selected: [true],
            defaultSort: '-id',
            entry: 'admin/log-actions'
        }
    },
    computed: {
        ...mapState({
            roles: state => state.admin.roles
        })
    },
    mounted() {
        this.getData()
    },
    methods: {
        roleName(value) {
            let role = this.roles.find(p => p.id == value)
            return role ? role.name : 'Loading...'
        },
        resourceName(string) {
            string = string.replace(/_/g, ' ');
            // return string.charAt(0).toUpperCase() + string.slice(1)
            string = string.split(" ")
            for (var i = 0, x = string.length; i < x; i++) {
                string[i] = string[i][0].toUpperCase() + string[i].substr(1)
            }
            return string.join(" ")
        },
        formartDataPermission(permissions) {
            let list = []
            if (permissions) {
                permissions = JSON.parse(permissions)
                Object.entries(permissions).forEach(([key, val]) => {
                    list.push({
                        text: key.charAt(0).toUpperCase() + key.substring(1), value: val, disabled: true
                    })
                })
            }
            return list
        }
    }
}
</script>
