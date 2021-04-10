<template>
    <page>
        <page-header header="💼 Add Category"></page-header>
        <page-body class="p-3" v-if="item">
            <b-jumbotron bg-variant="white" text-variant="white" border-variant="dark">
            <b-row>
                <b-col lg="12">
                    <b-card bg-variant="light" text-variant="dark" header-bg-variant="dark" header-text-variant="white">
                        <input-field :field="getField('name')" v-model="item.name"
                            :state="$v.item['name'] && $v.item['name'].$dirty ? !$v.item['name'].$error : null"
                            :error="fieldError(getField('name'))">
                        </input-field>
                        <input-field :field="getField('meta_title')" v-model="item.meta_title"
                            :state="$v.item['meta_title'] && $v.item['meta_title'].$dirty ? !$v.item['meta_title'].$error : null"
                            :error="fieldError(getField('meta_title'))">
                        </input-field>
                        <input-field :field="getField('description')"
                            :state="$v.item['description'] && $v.item['description'].$dirty ? !$v.item['description'].$error : null"
                            :error="fieldError(getField('description'))">
                            <b-textarea rows="6" v-model="item.description"></b-textarea>
                        </input-field>
                        <input-field :field="getField('meta_content')"
                            :state="$v.item['meta_content'] && $v.item['meta_content'].$dirty ? !$v.item['meta_content'].$error : null"
                            :error="fieldError(getField('meta_content'))">
                            <b-textarea rows="6" v-model="item.meta_content"></b-textarea>
                        </input-field>
                        <input-field :field="getField('image_url')" v-model="item.image_url"
                            :state="$v.item['image_url'] && $v.item['image_url'].$dirty ? !$v.item['image_url'].$error : null"
                            :error="fieldError(getField('image_url'))">
                        </input-field>
                        <input-field :field="getField('cover_photo')" v-model="item.cover_photo"
                            :state="$v.item['cover_photo'] && $v.item['cover_photo'].$dirty ? !$v.item['cover_photo'].$error : null"
                            :error="fieldError(getField('cover_photo'))">
                        </input-field>
                        <input-field :field="getField('status')" v-model="item.status"></input-field>
                        <input-field :field="getField('parent_id')" v-model="item.parent_id"
                            :state="$v.item['parent_id'] && $v.item['parent_id'].$dirty ? !$v.item['parent_id'].$error : null"
                            :error="fieldError(getField('parent_id'))">
                        </input-field>
                        <div class="text-center">
                            <b-btn
                                @click="create"
                                variant="success"
                                class="mr-5 w-25 mdi mdi-content-save"
                                v-b-tooltip.hover title="Create"></b-btn>

                            <b-btn
                                :to="{name: 'CategoryList'}"
                                class="w-25 mdi mdi-undo"
                                v-b-tooltip.hover title="Back"></b-btn>
                        </div>
                    </b-card>
                </b-col>
            </b-row>
            </b-jumbotron>
        </page-body>
    </page>
</template>

<script>
import fields from './fields'
import Add from '@/mixins/add'
import Validate from '@/mixins/validate'
import { required, minLength ,numeric} from 'vuelidate/lib/validators'

export default {
    name: 'CategoryAdd',
    mixins: [Add, Validate],
    data() {
        return {
            state: 0,
            fields,
            entry: 'crm/category',
            displayFields: ['name', 'description', 'meta_title', 'meta_content', 'image_url', 'cover_photo', 'status'],
        }
    },
    methods: {
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
            name: { required, minLength: minLength(2) },
            // description: { required, minLength: minLength(2) },
        }
    }
}
</script>