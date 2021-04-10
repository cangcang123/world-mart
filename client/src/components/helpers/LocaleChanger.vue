<template>
<div class="locale-changer">
    <b-form-select size="sm" v-model="lang" :options="langs" />
</div>
</template>

<script>
import { loadLanguageAsync } from '@/plugins/i18n'

export default {
    name: 'locale-changer',
    data () {
        return {
            lang: this.$i18n.locale,
            langs: [
                { value: 'en', text: 'English' },
                { value: 'vi', text: 'Tiếng Việt' },
            ]
        }
    },
    watch: {
        lang(val) {
            loadLanguageAsync(val)
        }
    }
}
</script>