import { buildURL } from '@/helpers/utils'
import axios from '@/plugins/axios'
import pkg from '@/services/admin/package'
import resource from '@/services/admin/resource'
import role from '@/services/admin/role'

const API_URL = process.env.VUE_APP_API_URL

export default {
    namespaced: true,
    state: {
        packages: [],
        resources: [],
        roles: []
    },
    mutations: {
        PACKAGES(state, packages) {
            state.packages = packages
        },
        RESOURCES(state, resources) {
            state.resources = resources
        },
        ROLES(state, roles) {
            state.roles = roles
        }
    },
    actions: {
        async getPackages({ commit }) {
            let packages = await pkg.getPackages()
            commit('PACKAGES', packages)
            return packages
        },
        async getResources({ commit }) {
            let resources = await resource.getResources()
            commit('RESOURCES', resources)
            return resources
        },
        async getRoles({ commit }) {
            let roles = await role.getRoles()
            commit('ROLES', roles)
            return roles
        },
    }
}