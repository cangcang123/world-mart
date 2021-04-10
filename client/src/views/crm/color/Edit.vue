<template>
    <page>
        <page-header header="🎨 Edit Color"></page-header>
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
                        <input-field :field="getField('status')" v-model="item.status"></input-field>
                        <div class="text-center">
                            <b-btn
                                @click="save" 
                                variant="success"
                                class="mr-5 w-25 mdi mdi-content-save"
                                v-b-tooltip.hover title="Save"></b-btn>

                            <b-btn
                                :to="{name: 'ColorList'}"
                                class="w-25 mdi mdi-undo"
                                v-b-tooltip.hover title="Back"></b-btn>
                        </div>
                    </b-card>
                </b-col>
                <b-col lg="4">
                    <b-row>
                        <b-col cols="12" order-lg="1">
                            <b-card bg-variant="light" text-variant="dark" header="Quiz's Setting" header-bg-variant="dark" header-text-variant="white">
                                <input-field :field="getField('color_code')"
                                    :state="$v.item['color_code'] && $v.item['color_code'].$dirty ? !$v.item['color_code'].$error : null"
                                    :error="fieldError(getField('color_code'))">
                                    <verte menuPosition="left" v-model="item.color_code" picker="square" model="hex" display="widget"></verte>
                                </input-field>
                            </b-card>
                        </b-col>
                    </b-row>
                </b-col>                
            </b-row>
            </b-jumbotron>
        </page-body>
    </page>
</template>

<script>
import fields from './fields'
import Edit from '@/mixins/edit'
import Validate from '@/mixins/validate'
import { required, minLength ,numeric} from 'vuelidate/lib/validators'

export default {
    name: 'ColorEdit',
    mixins: [Edit, Validate],
    data() {
        return {
            state: 0,
            fields,
            entry: 'crm/color',
            displayFields: ['name', 'description', 'color_code', 'status'],
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
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
    },
    validations: {
        item: {
            name: { required, minLength: minLength(2) },
            // description: { required, minLength: minLength(2) },
        }
    }
}
</script>