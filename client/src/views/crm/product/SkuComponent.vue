<template>
    <div>
        <div style="">
            <b-button :to="{name: 'ProductSkuAdd', params: {id: product_id}}" size="sm" variant="info">+ Add SKU</b-button>
        </div>
        <el-table :data="skus" style="width: 100%" v-if="!loading">
            <el-table-column prop="sku" label="SKU">
                <template slot-scope="scope">
                    <slot v-if="scope.row.new_sku">
                        <el-input
                            placeholder="Enter SKU"
                            v-model="scope.row.sku"
                        ></el-input>
                    </slot>
                    <slot v-else>
                        {{ scope.row.sku }}
                    </slot>
                </template>
            </el-table-column>
            <el-table-column prop="name" label="Name">
                <template slot-scope="scope">
                    <slot v-if="scope.row.new_sku">
                        <el-input
                            placeholder="Enter name"
                            v-model="scope.row.name"
                        ></el-input>
                    </slot>
                    <slot v-else>
                        {{ scope.row.name }}
                    </slot>
                </template>
            </el-table-column>
            <el-table-column prop="price" label="Price">
                <template slot-scope="scope">
                    <slot v-if="scope.row.new_sku">
                        <el-input
                            placeholder="Enter Price"
                            v-model="scope.row.price"
                        ></el-input>
                    </slot>
                    <slot v-else>
                        {{ scope.row.price }}
                    </slot>
                </template>
            </el-table-column>
            <el-table-column fixed="right" label="Options">
                <template slot-scope="scope">
                    <router-link :to="{name: 'SkusEdit', params: {id: scope.row.id}, query: { product_id: product_id }}">
                        <el-button
                            class="mr-2"
                            type="text"
                            size="small"
                            >Edit</el-button
                        >
                    </router-link>
                    <el-button
                        type="text"
                        size="small"
                        @click="deleteSku(scope.$index, scope.row)"
                        >Delete</el-button
                    >
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>
<script>
import { buildURL } from '@/helpers/utils'
import axios from '@/plugins/axios'
export default {
    props:{
        product_id:{
            required:true,
            type:String
        }
    },
    data(){
        return {
            edittingSku:'',
            loading: false,
            skus: [],
        }
    },
    methods: {
        deleteSku(index, data) {
            if (data.new_sku) {
                this.skus.splice(index, 1)
                this.addingSku = false
            } else {
                const API_URL = process.env.VUE_APP_API_URL
                let url = buildURL(API_URL, 'crm/skus/' + data.id)
                return axios.delete(url).then(res => {
                    this.skus.splice(index, 1)
                })
            }
        },
        getSkus() {
            const API_URL = process.env.VUE_APP_API_URL
            let url = buildURL(API_URL, 'crm/skus/product/' + this.product_id)
            this.loading = true
            return axios.get(url).then(res => {
                this.skus = res.data
                this.loading = false
            })
        },
    },
    mounted(){
        this.getSkus();
    }
}
</script>
