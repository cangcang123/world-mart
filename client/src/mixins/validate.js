import { fieldErrorMessage } from '@/helpers/utils'

export default {
    methods: {
        fieldError(field) {
            let key = field.key
            if (this.$v.item[key] && this.$v.item[key].$anyError) {
                let params = Object.keys(this.$v.item[key].$params)
                return params.filter(param => this.$v.item[key][param] === false)
                    .map(param => fieldErrorMessage(field, param, this.$v.item[key].$params[param]))[0]
            }
            return ''
        }
    }
}
