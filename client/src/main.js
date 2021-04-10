import Vue from 'vue'
import store from './store'
import router from './router'
import i18n from './plugins/i18n'
import App from './App.vue'

Vue.config.productionTip = false

import './boot'
import '@/assets/scss/style.scss'
import '@mdi/font/scss/materialdesignicons.scss'

const root = new Vue({
    i18n,
    store,
    router,
    render: h => h(App)
}).$mount('#app')

if (process.env.NODE_ENV !== 'production') {
    window.root = root
}
