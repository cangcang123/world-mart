import axios from 'axios'
import { buildURL } from '@/helpers/utils'
const API_URL = process.env.VUE_APP_API_URL

export default {
    getProvinces() {
        let url = buildURL(API_URL, 'admin/geo/provinces')
        return axios.get(url)
            .then(res => res.data)
            .catch(() => [])
    },

    getCountries() {
        let url = buildURL(API_URL, 'admin/geo/countries')
        return axios.get(url)
            .then(res => res.data)
            .catch(() => [])
    },

    getDistricts(province_code) {
        let url = buildURL(API_URL, 'admin/geo/districts', province_code)
        return axios.get(url)
            .then(res => res.data)
            .catch(() => [])
    },

    getWards(district_code) {
        let url = buildURL(API_URL, 'admin/geo/wards', district_code)
        return axios.get(url)
            .then(res => res.data)
            .catch(() => [])
    },

    geoToSelect(data) {
        return data.map(p => ({ text: p.name, value: p.code }))
    },

    geoToSelectCountry(data) {
        return data.map(p => ({ text: p.country_name, value: p.iso }))
    }
}
