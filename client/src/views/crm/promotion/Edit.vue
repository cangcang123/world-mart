<template>
    <page>
        <page-header header="🔖 Edit Promotion"></page-header>
        <page-body class="p-3" v-if="item">
            <b-jumbotron bg-variant="white" text-variant="white" border-variant="dark">
            <b-row>
                <b-col lg="8">
                    <b-card bg-variant="light" text-variant="dark" header-bg-variant="dark" header-text-variant="white">
                        <input-field :field="getField('name')" v-model="item.name"
                            :state="$v.item['name'] && $v.item['name'].$dirty ? !$v.item['name'].$error : null"
                            :error="fieldError(getField('name'))">
                        </input-field>
                        <input-field :field="getField('description')"
                            :state="$v.item['description'] && $v.item['description'].$dirty ? !$v.item['description'].$error : null"
                            :error="fieldError(getField('description'))">
                            <b-textarea rows="6" v-model="item.description"></b-textarea>
                        </input-field>
                        <div class="mt-2 mb-2">
                            <span>Sale Code</span>
                            <b-input-group
                                size="sm"
                                class="mt-2"
                                prepend="Code">
                                <b-form-input v-model="code"></b-form-input>
                                <b-input-group-append>
                                    <b-button size="sm" text="Button" variant="success" @click.prevent="generateCode()">Tạo Code</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </div> 
                        <input-field :field="getField('status')" v-model="item.status"></input-field>
                    </b-card>
                </b-col>
                <b-col lg="4">
                    <b-card bg-variant="light" text-variant="dark" header-bg-variant="dark" header-text-variant="white">
                        <span>Sale Duration</span>
                        <el-tooltip class="item" effect="dark" content="Choose date range to export" placement="top">
                            <date-range-custom size="sm" class="d-inline-block ml-2" :time.sync="time"></date-range-custom>
                        </el-tooltip>
                        <input-field :field="getField('start_date')" v-model="item.start_date"
                            :state="$v.item['start_date'] && $v.item['start_date'].$dirty ? !$v.item['start_date'].$error : null"
                            :error="fieldError(getField('start_date'))">
                        </input-field>
                        <input-field :field="getField('end_date')" v-model="item.end_date"
                            :state="$v.item['end_date'] && $v.item['end_date'].$dirty ? !$v.item['end_date'].$error : null"
                            :error="fieldError(getField('end_date'))">
                        </input-field>                       
                        <input-field :field="getField('value')" v-model="item.value"
                            :state="$v.item['value'] && $v.item['value'].$dirty ? !$v.item['value'].$error : null"
                            :error="fieldError(getField('value'))">
                        </input-field>
                        <input-field :field="getField('max_discount_price')" v-model="item.max_discount_price"
                            :state="$v.item['max_discount_price'] && $v.item['max_discount_price'].$dirty ? !$v.item['max_discount_price'].$error : null"
                            :error="fieldError(getField('max_discount_price'))">
                        </input-field>
                        <input-field :field="getField('min_order_price')" v-model="item.min_order_price"
                            :state="$v.item['min_order_price'] && $v.item['min_order_price'].$dirty ? !$v.item['min_order_price'].$error : null"
                            :error="fieldError(getField('min_order_price'))">
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
                            :to="{name: 'PromotionList'}"
                            class="w-25 mdi mdi-undo"
                            v-b-tooltip.hover title="Back"></b-btn>
                    </div>    
                </b-col>
            </b-row>
            </b-jumbotron>
        </page-body>
    </page>
</template>

<script>
import voucher_codes from 'voucher-code-generator';
import fields from './fields'
import Edit from '@/mixins/edit'
import Validate from '@/mixins/validate'
import { required, minLength ,numeric, decimal} from 'vuelidate/lib/validators'

export default {
    name: 'PromotionEdit',
    mixins: [Edit, Validate],
    data() {
        return {
            code: null,
            time: null,
            state: 0,
            fields,
            entry: 'crm/promotion',
            displayFields: ['name', 'description', 'status'],
        }
    },
    async mounted() {
        this.getData()
    },
    methods: {
        afterGotData(item) {
            this.code = item.code
            this.time = [moment(item.start_date).format('YYYY-MM-DD'), moment(item.end_date).format('YYYY-MM-DD')]
        },
        beforeSave() {
            this.$v.item.$touch()
            return !this.$v.item.$anyError
        },
        getField(key, appends = {}) {
            let field = this.fields.find(f => f.key == key)
            if (field) {
                return {...field, ...appends} 
            }
            return null
        },
        generateCode() {
            var code = voucher_codes.generate({
                length: 6,
                count: 1
            })
            this.item.code = code[0]
            this.code = code[0]
        }
    },
    watch: {
        time(val) {
            if(val) {
                this.item.start_date = this.time[0]
                this.item.end_date = this.time[1]
            }
        },
    },
    validations: {
        item: {
            name: { required, minLength: minLength(2) },
            value: { required, decimal },
            max_discount_price: { required, decimal },
            min_order_price: { required, decimal },
        }
    }
}
</script>