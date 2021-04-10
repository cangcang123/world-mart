<template>
    <page>
        <page-header header="📦 Add Product"></page-header>
        <page-body class="p-3" v-if="item">
            <b-row>
                <b-col lg="6">
                    <b-card bg-variant="light" text-variant="dark" header-bg-variant="dark" header-text-variant="white">
                        <input-field :field="getField('name')" v-model="item.name"
                            :state="$v.item['name'] && $v.item['name'].$dirty ? !$v.item['name'].$error : null"
                            :error="fieldError(getField('name'))">
                        </input-field>
                        <input-field :field="getField('meta_title')" v-model="item.meta_title"
                            :state="$v.item['meta_title'] && $v.item['meta_title'].$dirty ? !$v.item['meta_title'].$error : null"
                            :error="fieldError(getField('meta_title'))">
                        </input-field>
                        <input-field :field="getField('meta_content')"
                            :state="$v.item['meta_content'] && $v.item['meta_content'].$dirty ? !$v.item['meta_content'].$error : null"
                            :error="fieldError(getField('meta_content'))">
                            <b-textarea rows="13" v-model="item.meta_content"></b-textarea>
                        </input-field>
                        <input-field :field="getField('sub_description')"
                            :state="$v.item['sub_description'] && $v.item['sub_description'].$dirty ? !$v.item['sub_description'].$error : null"
                            :error="fieldError(getField('sub_description'))">
                            <b-textarea rows="13" v-model="item.sub_description"></b-textarea>
                        </input-field>
                        <input-field :field="getField('description')"
                            :state="$v.item['description'] && $v.item['description'].$dirty ? !$v.item['description'].$error : null"
                            :error="fieldError(getField('description'))">
                            <ckeditor :editor="editor" v-model="item.description" :config="editorConfig"></ckeditor>
                        </input-field>
                        <input-field :field="getField('usage')"
                            :state="$v.item['usage'] && $v.item['usage'].$dirty ? !$v.item['usage'].$error : null"
                            :error="fieldError(getField('usage'))">
                            <ckeditor :editor="editor" v-model="item.usage" :config="editorConfig"></ckeditor>
                        </input-field>
                        <input-field :field="getField('question_answer')"
                            :state="$v.item['question_answer'] && $v.item['question_answer'].$dirty ? !$v.item['question_answer'].$error : null"
                            :error="fieldError(getField('question_answer'))">
                            <ckeditor :editor="editor" v-model="item.question_answer" :config="editorConfig"></ckeditor>
                        </input-field>
                     </b-card>
                </b-col>
                <b-col lg="6">
                    <b-card bg-variant="light" text-variant="dark" header-bg-variant="dark" header-text-variant="white">
                        <input-field :field="getField('status')" v-model="item.status"></input-field>
                        <input-field :field="getField('is_hot')" v-model="item.is_hot"></input-field>
                        <input-field :field="getField('is_new')" v-model="item.is_new"></input-field>
                        <input-field :field="getField('is_profit')" v-model="item.is_profit"></input-field>
                        <input-field :field="getField('best_seller')" v-model="item.best_seller"></input-field>
                        <input-field :field="getField('price')" v-model="item.price"
                            :state="$v.item['price'] && $v.item['price'].$dirty ? !$v.item['price'].$error : null"
                            :error="fieldError(getField('price'))">
                        </input-field>
                        <input-field :field="getField('quota')" v-model="item.quota"
                            :state="$v.item['quota'] && $v.item['quota'].$dirty ? !$v.item['quota'].$error : null"
                            :error="fieldError(getField('quota'))">
                        </input-field>
                        <!-- <input-field :field="getField('sku')" v-model="item.sku"
                            :state="$v.item['sku'] && $v.item['sku'].$dirty ? !$v.item['sku'].$error : null"
                            :error="fieldError(getField('sku'))">
                        </input-field> -->
                        <input-field :field="getField('discount')" v-model="item.discount"
                            :state="$v.item['discount'] && $v.item['discount'].$dirty ? !$v.item['discount'].$error : null"
                            :error="fieldError(getField('discount'))">
                        </input-field>
                        <input-field :field="getField('bonus_rating')" v-model="item.bonus_rating"
                            :state="$v.item['bonus_rating'] && $v.item['bonus_rating'].$dirty ? !$v.item['bonus_rating'].$error : null"
                            :error="fieldError(getField('bonus_rating'))">
                        </input-field>
                        <input-field :field="getField('bonus_referral')" v-model="item.bonus_referral"
                            :state="$v.item['bonus_referral'] && $v.item['bonus_referral'].$dirty ? !$v.item['bonus_referral'].$error : null"
                            :error="fieldError(getField('bonus_referral'))">
                        </input-field>
                    </b-card>
                    <b-card bg-variant="light" text-variant="dark" header-bg-variant="dark" header-text-variant="white">
                        <input-field :field="getField('brand')" v-model="item.brand"
                            :state="$v.item['brand'] && $v.item['brand'].$dirty ? !$v.item['brand'].$error : null"
                            :error="fieldError(getField('brand'))">
                        </input-field>
                        <input-field :field="getField('category')" v-model="item.category"
                            :state="$v.item['category'] && $v.item['category'].$dirty ? !$v.item['category'].$error : null"
                            :error="fieldError(getField('category'))">
                        </input-field>
                        <input-field :field="getField('origin')" v-model="item.origin"
                            :state="$v.item['origin'] && $v.item['origin'].$dirty ? !$v.item['origin'].$error : null"
                            :error="fieldError(getField('origin'))">
                        </input-field>
                        <!-- <input-field :field="getField('memory')" v-model="item.memory"
                            :state="$v.item['memory'] && $v.item['memory'].$dirty ? !$v.item['memory'].$error : null"
                            :error="fieldError(getField('memory'))">
                        </input-field> -->
                        <!-- <input-field :field="getField('weight')" v-model="item.weight"
                            :state="$v.item['weight'] && $v.item['weight'].$dirty ? !$v.item['weight'].$error : null"
                            :error="fieldError(getField('weight'))">
                        </input-field> -->
                        <!-- <input-field :field="getField('color')" v-model="item.color"
                            :state="$v.item['color'] && $v.item['color'].$dirty ? !$v.item['color'].$error : null"
                            :error="fieldError(getField('color'))">
                        </input-field>
                        <input-field :field="getField('size')" v-model="item.size"
                            :state="$v.item['size'] && $v.item['size'].$dirty ? !$v.item['size'].$error : null"
                            :error="fieldError(getField('size'))">
                        </input-field> -->
                        <input-field :field="getField('promotion')" v-model="item.promotion"
                            :state="$v.item['promotion'] && $v.item['promotion'].$dirty ? !$v.item['promotion'].$error : null"
                            :error="fieldError(getField('promotion'))">
                        </input-field>
                        <b-card header="Cover" border-variant="danger">
                            <b-card-text class="text-muted">Ratio 16:10 (Recommend: 640 x 400 pixels)</b-card-text>
                            <div class="center">
                                <image-input v-model="item.cover_photo" :aspect-ratio="16/10"></image-input>
                            </div>
                        </b-card>
                        <b-card header="Images" border-variant="danger">
                            <b-card-text class="text-muted">Ratio 16:10 (Recommend: 640 x 400 pixels)</b-card-text>
                            <div class="center">
                                <image-multi v-model="list_images" :limit="10"/>
                            </div>
                        </b-card>
                    </b-card>
                </b-col>
            </b-row>
            <b-row>
                <b-col lg="12">
                    <div class="text-center">
                        <b-btn
                            @click="checkProduct"
                            variant="success"
                            class="mr-5 w-25 mdi mdi-content-save"
                            v-b-tooltip.hover title="Create"></b-btn>

                        <b-btn
                            :to="{name: 'ProductList'}"
                            class="w-25 mdi mdi-undo"
                            v-b-tooltip.hover title="Back"></b-btn>
                    </div>
                </b-col>
            </b-row>
        </page-body>
    </page>
</template>

<script>
import fields from './fields'
import ClassicEditor from '@/assets/build/ckeditor'
import Add from '@/mixins/add'
import axios from 'axios'
import { buildURL } from '@/helpers/utils'
import Validate from '@/mixins/validate'
import { required, minLength ,numeric, decimal, maxLength } from 'vuelidate/lib/validators'

export default {
    name: 'ProductAdd',
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
                bonus_rating: 10,
                bonus_referral: 10,
                is_new: 1,
                status: 2,
                is_hot: 2,
                is_profit: 2,
                best_seller: 2,
            },
            state: 0,
            fields,
            entry: 'crm/product',
            displayFields: ['name', 'description', 'meta_title', 'price', 'meta_content', 'image_url', 'cover_photo', 'status'],
        }
    },
    mounted() {
        this.item.image_url = [];
    },
    methods: {
        checkProduct() {
            const API_URL = process.env.VUE_APP_API_URL
            let url = buildURL(API_URL, 'crm/product/check-product')
            return axios.get(url, {
                params: {
                    name: this.item.name
                }
            }).then(res => {
                if(res.data.code == 400) {
                    this.$bvToast.toast(res.data.message, {
                        title: 'Error',
                        variant: 'danger'
                    })
                } else {
                    this.create()
                }
            })
        },
        beforeCreate() {
            if (typeof this.list_images !== 'string') {
                this.item.image_url = this.list_images
                this.item.image_url = JSON.stringify(this.item.image_url )
            }
            this.$v.item.$touch()
            return !this.$v.item.$anyError
        },
        afterCreated(item) {
            this.item.image_url = JSON.parse(this.item.image_url || '[]')
            if (item) {
                this.$bvToast.toast(item.name, {
                    title: 'Created',
                    variant: 'success'
                })

                setTimeout(() => {
                    this.$router.push({
                        name: 'ProductEdit',
                        params: {
                            id: item.id,
                        },
                    })
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
            bonus_rating: { required, decimal },
            bonus_referral: { required, decimal },
            // sub_description: { maxLength: maxLength(500) },
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