<template>
    <page>
        <page-header header="📦 Edit Product SKU"></page-header>
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
                        <input-field :field="getField('product_id')" v-model="product_id"
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
                            @click="save"
                            variant="success"
                            class="mr-5 w-25 mdi mdi-content-save"
                            v-b-tooltip.hover title="Save"></b-btn>

                        <b-btn
                            @click="redirect"
                            class="w-25 mdi mdi-undo"
                            v-b-tooltip.hover
                            title="Back"
                        ></b-btn>
                    </div>
                </b-col>
            </b-row>
        </page-body>
    </page>
</template>

<script>
import fields from './fields'
import Edit from '@/mixins/edit'
import store from '@/store'
import Validate from '@/mixins/validate'
import { required, minLength ,numeric, decimal, maxLength } from 'vuelidate/lib/validators'
import { isArray } from 'util'
import { buildURL } from '@/helpers/utils'
import axios from '@/plugins/axios'

export default {
    name: 'SkusEdit',
    mixins: [Edit, Validate],
    data() {
        return {
            fields,
            max: 10,
            message_type: null,
            firstChanged: true,
            entry: 'crm/skus',
            product_id: this.$route.query.product_id,
        }
    },
    computed: {
        readonly() {
            return this.item && this.item.state == 1
        },
    },
    mounted() {
        this.getData()
    },
    watch: {},
    methods: {
        redirect(){
            if (this.product_id) {
                this.$router.push({
                    name: 'ProductEdit',
                    params: {
                        id: this.product_id,
                    },
                })
            } else {
                this.$router.push({
                    name: 'SkusList',
                })
            }

        },
        beforeSave() {
            this.$v.item.$touch()
            return !this.$v.item.$anyError
        },
        getField(key, appends = {}) {
            let field = this.fields.find(f => f.key == key)
            if (field) {
                return { ...field, ...appends }
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
    },
}
</script>
<style lang="scss" scoped>
.propery-content-input {
    padding: 10px;
    width: 100%;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}
</style>
