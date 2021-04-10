<template>
<page>
    <page-header>️🖍 Product Reviews</page-header>

    <action-bar @change="onFilterChanged">
    </action-bar>

    <b-table class="bg-white shadow-sm" table-class="mb-0"
        :items="items"
        :fields="tableFields"
        :busy="loading"
        bordered
        show-empty striped hover responsive selectable no-local-sorting
        @sort-changed="onSortChanged"
        @row-selected="_rowSelected">

        <template v-slot:table-busy>
            <div class="text-center my-2">
                <b-spinner class="align-middle" small variant="warning" type="grow"></b-spinner>
                <b-spinner class="align-middle" small variant="success" type="grow"></b-spinner>
                <b-spinner class="align-middle" small variant="info" type="grow"></b-spinner>
            </div>
        </template>

        <template v-slot:cell(title)="data">
            <b-badge variant="info">{{ data.value }}</b-badge>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 1" variant="success">Publish</b-badge>
            <b-badge v-else-if="data.value === 2" variant="danger">UnPublish</b-badge>
            <b-badge v-else variant="dark">Undefined</b-badge>
        </template>

        <template v-slot:cell(description)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(images)="data">
            <p v-html="getImages(data.value)"></p>
        </template>
<!-- 
        <template v-slot:cell(images)="data">
            <img width="70" :key="idx" :src="image" v-for="(image,idx) in JSON.parse(data.item.images, true)"/>
        </template> -->

        <template v-slot:cell(options)="data">
            <b-button id="Active" size="sm" variant="success" class="mr-1 mdi mdi-thumb-up-outline" @click="onActive(data.item)"></b-button>
            <b-tooltip target="Active" triggers="hover">Active</b-tooltip>

            <b-button id="InActive" size="sm" variant="danger" class="mr-1 mdi mdi-thumb-down-outline" @click="onInactive(data.item)"></b-button>
            <b-tooltip target="InActive" triggers="hover">InActive</b-tooltip>

            <b-button id="Delete" size="sm" variant="danger" class="mr-1 mdi mdi-trash-can" @click="deleteItem(data.item)"></b-button>
            <b-tooltip target="Delete" triggers="hover">Delete</b-tooltip>
        </template>
    </b-table>

    <pagination class="mt-3" />
</page>
</template>

<script>
import List from '@/mixins/list'
import fields from './fields'
import { mapState } from 'vuex'
import { buildURL } from '@/helpers/utils'
import axios from 'axios'

export default {
    name: 'ProductReviewList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: [
                'id',
                'title',
                'description',
                'product_id',
                'user_name',
                'rating',
                'status',
                'created_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                title: '',
                user_name: '',
                status: '',
            },
            file: '',
            defaultSort: '-id',
            entry: 'crm/product-review'
        }
    },
    computed: {
    },
    mounted() {
        this.getData()
    },
    methods: {
        async deleteItem(item) {
            this.$confirm('Delete this review. Continue?', 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(async () => {
                item.deleted = 1
                let entry = await this.$service.update(item.id, item)
                // let entry = await this.$service.delete(item.id)
                if(entry) this.$message.success('✔ Deleted')
                this.getData()
            })
        },
        getImages(images) {
            var img = JSON.parse(images, true)
            if (img.length) {
                var html = '';
                img.forEach(function(a, index) {
                    html +=`<img width="70" src="${a}" style="margin:5px 5px 5px 5px"/>`;
                })
                return html
            }
            return '[No images]'
        },
        async onActive(item) {
            item.status = 1
            let entry = await this.$service.update(item.id, item)
            if(entry) this.$message.success('✔ Approved')
        },

        async onInactive(item) {
            item.status = 2
            let entry = await this.$service.update(item.id, item)
            if(entry) this.$message.warning('❌ Rejected')
        },
    }
}
</script>