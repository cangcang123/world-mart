<template>
    <page>
        <page-header header="📚 Add SKU"></page-header>
        <page-body class="p-3" v-if="item">
            <b-jumbotron
                bg-variant="white"
                text-variant="white"
                border-variant="dark"
            >
                <b-row>
                    <b-col lg="12">
                        <!-- sku basic info block -->
                        <b-card
                            bg-variant="light"
                            text-variant="dark"
                            header="SKU"
                            header-bg-variant="dark"
                            header-text-variant="white"
                        >
                            <!-- Name -->
                            <input-field
                                :field="getField('name')"
                                v-model="item.name"
                                :state="
                                    $v.item['name'] && $v.item['name'].$dirty
                                        ? !$v.item['name'].$error
                                        : null
                                "
                                :error="fieldError(getField('name'))"
                            >
                            </input-field>
                            <!-- End of Name -->
                            <!--product_id -->
                            <input-field
                                :field="getField('product_id')"
                                v-model="item.product_id"
                                :state="
                                    $v.item['product_id'] &&
                                    $v.item['product_id'].$dirty
                                        ? !$v.item['product_id'].$error
                                        : null
                                "
                                :error="fieldError(getField('product_id'))"
                            >
                            </input-field>
                            <!-- End of product_id -->
                            <!--sku_code -->
                            <input-field
                                :field="getField('sku_code')"
                                v-model="item.sku_code"
                                :state="
                                    $v.item['sku_code'] &&
                                    $v.item['sku_code'].$dirty
                                        ? !$v.item['sku_code'].$error
                                        : null
                                "
                                :error="fieldError(getField('sku_code'))"
                            >
                            </input-field>
                            <!-- sku_code -->
                            <!--status -->
                            <input-field
                                :field="getField('status')"
                                v-model="item.status"
                                :state="
                                    $v.item['status'] &&
                                    $v.item['status'].$dirty
                                        ? !$v.item['status'].$error
                                        : null
                                "
                                :error="fieldError(getField('status'))"
                            >
                            </input-field>
                            <!-- End of status -->
                            <!-- End of description -->
                            <div class="text-center">
                                <b-btn
                                    @click="create"
                                    :disabled="!item.product_id"
                                    variant="success"
                                    class="mr-5 w-25 mdi mdi-content-save"
                                    v-b-tooltip.hover
                                    title="Create"
                                ></b-btn>

                                <b-btn
                                    :to="{
                                        name: 'SkusList',
                                    }"
                                    class="w-25 mdi mdi-undo"
                                    v-b-tooltip.hover
                                    title="Back"
                                ></b-btn>
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
import { required, minLength, numeric } from 'vuelidate/lib/validators'
export default {
    name: 'SkusAdd',
    mixins: [Add, Validate],
    components: {},
    data() {
        return {
            item: {},
            state: 0,
            fields,
            itemUser: {},
            campaign: '',
            entry: 'crm/skus',
            displayFields: [
                'name',
                'status',
                'sku_code',
                'product_id',
            ],
        }
    },
    mounted() {},
    methods: {
        beforeCreate() {
            this.$v.item.$touch()
            return !this.$v.item.$anyError
        },
        afterCreated(item) {
            if (item) {
                this.$bvToast.toast(item.name, {
                    title: 'Created',
                    variant: 'success',
                })
                this.$router.push({
                    name: 'SkusEdit',
                    params: {
                        id: item.id,
                    },
                })
            }
        },
        onResetRowItem() {
            this.itemUser = {}
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
            // name: { required, minLength: minLength(2) },
            // description: { required, minLength: minLength(2) },
            // // campaign_id: { required },
            // area: { required },
        },
    },
}
</script>
