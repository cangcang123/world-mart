import axios from 'axios'
import { buildURL } from '@/helpers/utils';

const API_URL = process.env.VUE_APP_API_URL

export function fields(entry) {
    let url = buildURL(API_URL, 'admin/entries/fields')
    return axios.get(url, { params: { entry }}).then(res => res.data)
}

export function sync(entry, display_fields) {
    let url = buildURL(API_URL, 'admin/entries/fields')
    return axios.post(url, { entry, display_fields })
        .then(res => res.data)
}