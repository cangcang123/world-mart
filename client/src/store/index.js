import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import layout from './layout'
import crm from './crm'
import message from './message'
import admin from './admin'

import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        layout,
        crm,
        message,
        admin,
    },
    plugins: [
        createPersistedState({
            key: 'bluescope',
            paths: ['layout']
        })
    ],
})


export default store