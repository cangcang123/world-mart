<template>
    <page>
        <page-header header="Edit Order"></page-header>
        <page-body class="p-3" v-if="item">
            <input-field :field="getField('status')" v-model="item.status"></input-field>
            <div class="text-center">
                <b-btn
                    @click="save"
                    variant="success"
                    class="mr-5 w-25 mdi mdi-content-save"
                    v-b-tooltip.hover title="Save"></b-btn>

                <b-btn
                    :to="{name: 'OrderList'}"
                    class="w-25 mdi mdi-undo"
                    v-b-tooltip.hover title="Back"></b-btn>
            </div>
        </page-body>
    </page>
</template>

<script>
import fields from './edit_fields'
import Edit from '@/mixins/edit'
import Validate from '@/mixins/validate'

export default {
    name: 'OrderEdit',
    mixins: [Edit, Validate],
    data() {
        return {
            state: 0,
            fields,
            entry: 'crm/order',
            displayFields: ['status'],
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
        }
    }
}
</script>