<template>
<page>
    <page-header>📦 Products</page-header>

    <action-bar @change="onFilterChanged">
        <b-button :to="{name: 'ProductAdd'}" class=" mdi mdi-plus mb-3 float-right" variant="success" size="sm" slot="header-right">Add Product</b-button>
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

        <template v-slot:cell(is_hot)="data">
            <b-badge v-if="data.value === 1" variant="success">On</b-badge>
            <b-badge v-else-if="data.value === 2" variant="danger">Off</b-badge>
            <b-badge v-else variant="dark">Undefined</b-badge>
        </template>

        <template v-slot:cell(is_new)="data">
            <b-badge v-if="data.value === 1" variant="success">Yes</b-badge>
            <b-badge v-else-if="data.value === 2" variant="danger">No</b-badge>
            <b-badge v-else variant="dark">Undefined</b-badge>
        </template>

        <template v-slot:cell(is_profit)="data">
            <b-badge v-if="data.value === 1" variant="success">Yes</b-badge>
            <b-badge v-else-if="data.value === 2" variant="danger">No</b-badge>
            <b-badge v-else variant="dark">Undefined</b-badge>
        </template>

        <template v-slot:cell(best_seller)="data">
            <b-badge v-if="data.value === 1" variant="success">Yes</b-badge>
            <b-badge v-else-if="data.value === 2" variant="danger">No</b-badge>
            <b-badge v-else variant="dark">Undefined</b-badge>
        </template>

        <template v-slot:cell(status)="data">
            <b-badge v-if="data.value === 1" variant="success">On</b-badge>
            <b-badge v-else-if="data.value === 2" variant="danger">Off</b-badge>
            <b-badge v-else variant="dark">Undefined</b-badge>
        </template>

        <template v-slot:cell(description)="data">
            <p>{{'[HTML Content]'}}</p>
        </template>

        <template v-slot:cell(sub_description)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(origin)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(discount)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(meta_content)="data">
            <p>{{'[HTML Content]'}}</p>
        </template>

        <template v-slot:cell(quota)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(bonus_rating)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(category)="data">
            <p>{{ getCate(data.value) || 'N/A' }}</p>
        </template>

        <template v-slot:cell(color)="data">
            <p>{{ getColor(data.value) || 'N/A' }}</p>
        </template>

        <template v-slot:cell(size)="data">
            <p>{{ getSize(data.value) || 'N/A' }}</p>
        </template>

        <template v-slot:cell(brand)="data">
            <p>{{ getBrand(data.value) || 'N/A' }}</p>
        </template>

        <template v-slot:cell(promotion)="data">
            <p>{{ getPromotion(data.value) || 'N/A' }}</p>
        </template>

        <template v-slot:cell(country)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(meta_title)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(weight)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(memory)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(sku)="data">
            <p>{{ data.value || 'N/A' }}</p>
        </template>

        <template v-slot:cell(image_url)="data">
            <div class="text-center" >
                <b-img thumbnail :src="getImg(data.value) || 'https://via.placeholder.com/210x140?text=Thumbnail Article'" width=100 ></b-img>
            </div>
        </template>
        <template v-slot:cell(cover_photo)="data">
            <div class="text-center" >
                <b-img thumbnail :src="data.value || 'https://via.placeholder.com/210x140?text=Thumbnail Article'" width=100 ></b-img>
            </div>
        </template>
        <!-- <template v-slot:cell(image_url)="data">
            <img width="70" :key="idx" :src="image.url" v-for="(image,idx) in data.item.image_url"/>
        </template> -->
        <template v-slot:cell(options)="data">
            <b-button id="Active" size="sm" variant="success" class="mr-1 mdi mdi-thumb-up-outline" @click="onActive(data.item)"></b-button>
            <b-tooltip target="Active" triggers="hover">Active</b-tooltip>

            <b-button id="InActive" size="sm" variant="danger" class="mr-1 mdi mdi-thumb-down-outline" @click="onInactive(data.item)"></b-button>
            <b-tooltip target="InActive" triggers="hover">InActive</b-tooltip>

            <b-button id="Delete" size="sm" variant="danger" class="mr-1 mdi mdi-trash-can" @click="deleteItem(data.item)"></b-button>
            <b-tooltip target="Delete" triggers="hover">Delete</b-tooltip>

            <b-button-group>
                <b-button id="ProductEdit" :to="{name: 'ProductEdit', params: {id: data.item.id}}" size="sm" variant="warning" class="mdi mdi-circle-edit-outline"></b-button>
                <b-tooltip target="ProductEdit" triggers="hover">Edit</b-tooltip>
            </b-button-group>
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
import store from '@/store'

export default {
    name: 'ProductList',
    mixins: [List],
    data() {
        return {
            fields,
            displayFields: [
                'id',
                'name',
                'image_url',
                'description',
                'price',
                'currency',
                'discount',
                'bonus_rating',
                'quota',
                'origin',
                'brand',
                'category',
                'color',
                'size',
                'memory',
                'weight',
                'sku',
                'promotion',
                'is_hot',
                'status',
                'created_at'
            ],
            appendColumns: [
                'options'
            ],
            defaultFilter: {
                name: '',
                memory: '',
                weight: '',
                sku: '',
                status: undefined,
                color: undefined,
                category: undefined,
                brand: undefined,
                size: undefined,
                promotion: undefined,
                origin: undefined,
                is_new: '',
                is_hot: '',
                is_profit: '',
                best_seller: '',
            },
            file: '',
            defaultSort: '-created_at',
            entry: 'crm/product'
        }
    },
    computed: {
    },
    mounted() {
        this.getData()
        this.getCates()
        this.getColors()
        this.getSizes()
        this.getBrands()
        this.getPromotions()
    },
    methods: {
        async deleteItem(item) {
            this.$confirm('Delete this product. Continue?', 'Warning', {
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
        async getSizes() {
            if (!store.state.crm.size.length) {
                await store.dispatch('crm/getSizes')
            }
        },
        async getBrands() {
            if (!store.state.crm.brand.length) {
                await store.dispatch('crm/getBrands')
            }
        },
        async getPromotions() {
            if (!store.state.crm.promotion.length) {
                await store.dispatch('crm/getPromotions')
            }
        },
        async getColors() {
            if (!store.state.crm.color.length) {
                await store.dispatch('crm/getColors')
            }
        },
        async getCates() {
            if (!store.state.crm.category.length) {
                await store.dispatch('crm/getCategories')
            }
        },
        getCate(id) {
            if (store.state.crm.category.length > 0) {
                let res = store.state.crm.category.find(f => {
                    return f.id == id
                })
                return res ? res.name : id
            }
            return id
        },
        getPromotion(id) {
            if (store.state.crm.promotion.length > 0) {
                let res = store.state.crm.promotion.find(f => {
                    return f.id == id
                })
                return res ? res.name : id
            }
            return id
        },
        getBrand(id) {
            if (store.state.crm.brand.length > 0) {
                let res = store.state.crm.brand.find(f => {
                    return f.id == id
                })
                return res ? res.name : id
            }
            return id
        },
        getColor(id) {
            if (store.state.crm.color.length > 0) {
                let res = store.state.crm.color.find(f => {
                    return f.id == id
                })
                return res ? res.name : id
            }
            return id
        },
        getImg(images) {
            let img = JSON.parse(images || '[]')
            if (img.length > 0) {
                return img[0]
            } else {
                return null
            }
        },
        getSize(id) {
            if (store.state.crm.size.length > 0) {
                let res = store.state.crm.size.find(f => {
                    return f.id == id
                })
                return res ? res.name : id
            }
            return id
        }
    }
}
</script>