import { buildURL } from '@/helpers/utils'
import axios from '@/plugins/axios'
import geo from '@/services/geo'
import StoreService from '@/services/crm/store'
import CURD from '@/services/curd'

const API_URL = process.env.VUE_APP_API_URL

export default {
    namespaced: true,
    state: {
        officialAccounts: [],
        genders: [
            { text: 'Undefined', value: 0 },
            { text: 'Male', value: 1 },
            { text: 'Female', value: 2 },
            { text: 'Other', value: 3 },
        ],
        provinces: [],
        countries: [],
        stores: [],
        brand: [],
        category: [],
        products:[],
        color: [],
        size: [],
        promotion: [],
    },
    mutations: {
        PROVINCES(state, provinces) {
            state.provinces = provinces
        },
        COUNTRIES(state, countries) {
            state.countries = countries
        },
        CATEGORIES(state, category) {
            state.category = category
        },
        BRANDS(state, brand) {
            state.brand = brand
        },
        SIZES(state, size) {
            state.size = size
        },
        PRODUCTS(state, products) {
            state.products = products
        },
        COLORS(state, color) {
            state.color = color
        },
        PROMOTIONS(state, promotion) {
            state.promotion = promotion
        },
        STORES(state, stores) {
            state.stores = stores
        }
    },
    actions: {
        async getProvinces({ commit }) {
            let provinces = await geo.getProvinces()
            commit('PROVINCES', provinces)
            return provinces
        },
        async getCountries({ commit }) {
            let countries = await geo.getCountries()
            commit('COUNTRIES', countries)
            return countries
        },
        async getBrands({ commit }) {
            let url = buildURL(API_URL, 'crm/brand')
            let params = {limit: 100}
            return axios.get(url,{params}).then(res => {
                commit('BRANDS', res.data.entries || [])
            })
        },
        async getPromotions({ commit }) {
            let url = buildURL(API_URL, 'crm/promotion')
            return axios.get(url).then(res => {
                commit('PROMOTIONS', res.data.entries || [])
            })
        },
        async getColors({ commit }) {
            let url = buildURL(API_URL, 'crm/color')
            return axios.get(url).then(res => {
                commit('COLORS', res.data.entries || [])
            })
        },
        getProducts({ commit }) {
            let url = buildURL(API_URL, 'crm/product')
            return axios.get(url).then(res => {
                commit('PRODUCTS', res.data.entries || [])
            })
        },
        async getSizes({ commit }) {
            let url = buildURL(API_URL, 'crm/size')
            return axios.get(url).then(res => {
                commit('SIZES', res.data.entries || [])
            })
        },
        async getCategories({ commit }) {
            let url = buildURL(API_URL, 'crm/category')
            // let categoryService = new CURD('crm/category')
            // let res = await categoryService.list({limit: 100})
            // commit('CATEGORIES', res.data.entries || [])
            // return res.data.entries
            let params = {limit: 100}
            return axios.get(url,{params}).then(res => {
                commit('CATEGORIES', res.data.entries || [])
            })
        },
        async getStores({ commit }) {
            let res = await StoreService.list({limit: 100})
            commit('STORES', res.entries)
            return res.entries
        }
    }
}
