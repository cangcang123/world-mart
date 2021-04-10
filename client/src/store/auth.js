import { getItem, setItem } from '@/helpers/localStorage'
import authService from '@/services/auth'
import axios from '@/plugins/axios'
import router from '@/router';

export default {
    namespaced: true,
    state: {
        user: null,
        token: getItem('token') || ''
    },
    mutations: {
        TOKEN(state, value) {
            state.token = value
            setItem('token', value)
            if (value) {
                axios.defaults.headers.common[
                    'Authorization'
                ] = `Bearer ${value}`
            } else {
                delete axios.defaults.headers.common['Authorization']
            }
        },
        USER(state, value) {
            state.user = value
        }
    },
    actions: {
        async getProfile({ commit }) {
            let user = await authService.getProfile()
            commit('USER', user)
            if (!user) {
                commit('TOKEN', null)
            }
        },
        async logout({ commit }) {
            await authService.logout()
            commit('TOKEN', '')
            commit('USER', null)
            router.push({
                name: 'Login'
            })
        }
    }
}
