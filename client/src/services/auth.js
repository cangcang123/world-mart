import axios from 'axios'
import { buildURL } from '@/helpers/utils'

const API_URL = process.env.VUE_APP_API_URL
const pipe = res => res.data

function getProfile() {
    let url = buildURL(API_URL, 'admin/auth/me')
    return axios.get(url).then(pipe).catch(() => null)
}

function login(username, password) {
    let url = buildURL(API_URL, 'admin/auth/login')
    return axios.post(url, { username, password }).then(pipe)
}

function logout() {
    let url = buildURL(API_URL, 'admin/auth/logout')
    return axios.post(url).then(pipe)
}

export default {
    getProfile,
    login,
    logout,
}
