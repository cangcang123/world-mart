<template>
    <page>
        <page-header header="📦 Add Product SKU"></page-header>
        <page-body class="p-3" v-if="item">
            <b-row>
                <b-col lg="6">
                    <b-card bg-variant="light" text-variant="dark" header-bg-variant="dark" header-text-variant="white">
                        <input-field :field="getField('name')" v-model="item.name"
                            :state="$v.item['name'] && $v.item['name'].$dirty ? !$v.item['name'].$error : null"
                            :error="fieldError(getField('name'))">
                        </input-field>
                        <input-field :field="getField('description')"
                            :state="$v.item['description'] && $v.item['description'].$dirty ? !$v.item['description'].$error : null"
                            :error="fieldError(getField('description'))">
                            <b-textarea rows="13" v-model="item.sub_description"></b-textarea>
                        </input-field>
                     </b-card>
                    <b-card header="Cover" border-variant="danger">
                        <b-card-text class="text-muted">Ratio 16:10 (Recommend: 640 x 400 pixels)</b-card-text>
                        <div class="center">
                            <image-input v-model="item.thumbnail" :aspect-ratio="16/10"></image-input>
                        </div>
                    </b-card>
                </b-col>
                <b-col lg="6">
                    <b-card bg-variant="light" text-variant="dark" header-bg-variant="dark" header-text-variant="white">
                        <input-field :field="getField('product_id')" v-model="productId"
                            :state="$v.item['product_id'] && $v.item['product_id'].$dirty ? !$v.item['product_id'].$error : null"
                            :error="fieldError(getField('product_id'))">
                        </input-field>
                        <input-field :field="getField('status')" v-model="item.status"></input-field>
                        <input-field :field="getField('price')" v-model="item.price"
                            :state="$v.item['price'] && $v.item['price'].$dirty ? !$v.item['price'].$error : null"
                            :error="fieldError(getField('price'))">
                        </input-field>
                        <input-field :field="getField('sku')" v-model="item.sku"
                            :state="$v.item['sku'] && $v.item['sku'].$dirty ? !$v.item['sku'].$error : null"
                            :error="fieldError(getField('sku'))">
                        </input-field>
                        <input-field :field="getField('quantity')" v-model="item.quantity"
                            :state="$v.item['quantity'] && $v.item['quantity'].$dirty ? !$v.item['quantity'].$error : null"
                            :error="fieldError(getField('quantity'))">
                        </input-field>
                        <input-field :field="getField('color')" v-model="item.color"
                            :state="$v.item['color'] && $v.item['color'].$dirty ? !$v.item['color'].$error : null"
                            :error="fieldError(getField('color'))">
                        </input-field>
                        <input-field :field="getField('size')" v-model="item.size"
                            :state="$v.item['size'] && $v.item['size'].$dirty ? !$v.item['size'].$error : null"
                            :error="fieldError(getField('size'))">
                        </input-field>
                        <input-field :field="getField('weight')" v-model="item.weight"
                            :state="$v.item['weight'] && $v.item['weight'].$dirty ? !$v.item['weight'].$error : null"
                            :error="fieldError(getField('weight'))">
                        </input-field>
                        <input-field :field="getField('memory')" v-model="item.memory"
                            :state="$v.item['memory'] && $v.item['memory'].$dirty ? !$v.item['memory'].$error : null"
                            :error="fieldError(getField('memory'))">
                        </input-field>
                    </b-card>
                </b-col>
            </b-row>
            <b-row>
                <b-col lg="12">
                    <div class="text-center">
                        <b-btn
                            @click="checkSku"
                            variant="success"
                            class="mr-5 w-25 mdi mdi-content-save"
                            v-b-tooltip.hover title="Create"></b-btn>
                        <b-btn
                            :to="{name: 'ProductEdit', params: {id: $route.params.id}}"
                            class="w-25 mdi mdi-undo"
                            v-b-tooltip.hover title="Back"></b-btn>
                    </div>
                </b-col>
            </b-row>
        </page-body>
    </page>
</template>

<script>
import axios from 'axios'
import fields from '../skus/fields'
import ClassicEditor from '@/assets/build/ckeditor'
import Add from '@/mixins/add'
import { buildURL } from '@/helpers/utils'
import Validate from '@/mixins/validate'
import { required, minLength ,numeric, decimal, maxLength } from 'vuelidate/lib/validators'

export default {
    name: 'ProductSkuAdd',
    mixins: [Add, Validate],
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                simpleUpload: {
                    uploadUrl: buildURL(process.env.VUE_APP_API_URL, 'admin/upload/image'),
                    headers: {
                        Authorization: 'Bearer ' + this.$store.state.auth.token
                    },
                }
            },
            list_images: [],
            item: {
                product_id: this.$route.params.id,
                bonus_rating: 10,
                bonus_referral: 10,
            },
            state: 0,
            productId: '',
            fields,
            entry: 'crm/skus',
        }
    },
    mounted() {
        this.productId = this.$route.params.id;
    },
    methods: {
        checkSku() {
            const API_URL = process.env.VUE_APP_API_URL
            let url = buildURL(API_URL, 'crm/skus/check-sku/'+ this.item.sku)
            return axios.get(url).then(res => {
                if(res.data.code == 400) {
                    this.$bvToast.toast('Lỗi', {
                        title: res.data.message,
                        variant: 'danger'
                    })
                } else {
                    this.create()
                }
            })
        },
        beforeCreate() {
            this.$v.item.$touch()
            return !this.$v.item.$anyError
        },
        afterCreated(item) {
            if (item) {
                this.$bvToast.toast(item.name, {
                    title: 'Created',
                    variant: 'success'
                })

                setTimeout(() => {
                    this.$router.go(this.$router.currentRoute)
                }, 500)
            }
        },
        getField(key, appends = {}) {
            let field = this.fields.find(f => f.key == key)
            if (field) {
                return {...field, ...appends}
            }
            return null
        },
    },
    validations: {
        item: {
            name: { required, minLength: minLength(2), maxLength: maxLength(255) },
            price: { required, decimal },
            sku: { required },
            product_id: { required },
            quantity: { required, numeric },
        }
    }
}
</script>
<style>
.center {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>