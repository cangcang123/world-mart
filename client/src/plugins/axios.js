import Vue from 'vue'
import axios from 'axios'
import { getItem } from '@/helpers/localStorage'

const token = getItem('token')

if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}

Vue.prototype.$http = axios

export default axios