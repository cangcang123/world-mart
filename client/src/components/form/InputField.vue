<template>
<b-form-group :label="inputLabel">
    <slot>
        <component :is="inputComponentName" v-bind.sync="componentProps" @input="onInput">
            <template v-if="inputComponentName == 'el-select'">
                <el-option v-for="(option, index) in options" :key="index" :label="option.text" :value="option.value"></el-option>
            </template>
            {{ innerContent }}
        </component>
    </slot>
    <b-form-invalid-feedback :state=false v-if="state === false && error">{{ error }}</b-form-invalid-feedback>
</b-form-group>
</template>

<script>
import { fieldLabel } from '@/helpers/utils'

export default {
    name: 'InputField',
    props: {
        field: {
            type: Object,
            required: true
        },
        value: {
            type: null,
            required: false
        },
        filter: {
            type: Boolean,
            default: false
        },
        state: {
            type: Boolean,
            default: null
        },
        error: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            options: []
        }
    },
    computed: {
        inputComponentName() {
            switch(this.field.type) {
                case 'price':
                    return 'price-input'
                case 'image':
                    return 'image-input'
                case 'image_multi':
                    return 'image-input-multi'
                case 'date':
                case 'time':
                case 'datetime':
                    return 'datetime'
                case 'bit':
                case 'boolean':
                    return 'b-form-checkbox'
                case 'select':
                    // return 'b-form-select'
                    return 'el-select'
                case 'text':
                    return 'b-form-textarea'
            }
            return 'b-form-input'
        },
        componentProps() {
            let props = {
                value: this.value,
                state: this.state
            }

            if (this.filter) {
                props.size = this.inputComponentName.startsWith('el-') ? 'small' : 'sm'
            }

            if (this.field.readonly && !this.filter) {
                if (!['image-input', 'el-select'].includes(this.inputComponentName))
                    props.readonly = true
                else
                    props.disabled = true
            }

            if (this.field.type === 'boolean') {
                props.value = true
                props.checked = this.value
            }

            if (this.field.type === 'number') {
                props.type = 'number'
            }

            if (this.field.type === 'bit') {
                props.value = 1
                props.uncheckedValue = 0
                props.checked = this.value
            }

            if (this.field.type === 'select') {
                props.filterable = true
                props.clearable = true
                props.class = 'w-100'
            }

            if (this.field.type === 'date') {
                props.inputClass = 'form-control'
                props.type = 'date'
                props.valueZone = 'local'
                props.format = 'yyyy-MM-dd'
            }

            if (this.field.type === 'datetime') {
                props.inputClass = 'form-control'
                props.type = 'datetime'
            }
            return props
        },
        innerContent() {
            if (this.field.type === 'boolean') {
                return fieldLabel(this.field)
            }
        },
        inputLabel() {
            if (this.field.type !== 'boolean') {
                return fieldLabel(this.field)
            }
        }
    },
    created() {
        if (this.field.options) {
            if (typeof this.field.options === 'function') {
                this.field.options().then(options => {
                    this.options = options
                })
            }
            else if (Array.isArray(this.field.options)) {
                this.options = this.field.options.map(o => {
                    if (typeof o === 'string') {
                        return {
                            text: o,
                            value: o
                        }
                    }
                    return o
                })
            }
        }
    },
    methods: {
        onInput(value) {
            if (typeof this.field.onInputFormat === 'function') {
                value = this.field.onInputFormat(value)
            }
            this.$emit('input', value)
        }
    }
}
</script>
