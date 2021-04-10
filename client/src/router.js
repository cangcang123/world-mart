import Vue from 'vue'
import Router from 'vue-router'
import routes from '@/routes'
import store from '@/store'

Vue.use(Router)

const router = new Router({
    mode: process.env.BUILD_MODE || 'hash',
    base: process.env.BASE_URL,
    routes,
})

router.beforeEach(async (to, from, next) => {
    let requiresAuth = to.matched.some(r => r.meta.requiresAuth)
    if (requiresAuth) {
        if (store.state.auth.token && !store.state.auth.user) {
            await store.dispatch('auth/getProfile')
        }
        if (!store.state.auth.user) {
            return next({
                name: 'Login',
                query: to.query
            })
        }
    }

    store.dispatch('message/messagePage', to.name === 'Messages')

    next()
})

export default router
