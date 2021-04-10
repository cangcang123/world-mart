import axios from 'axios'
import { buildURL } from '@/helpers/utils'
const API_URL = process.env.VUE_APP_API_URL

export default {
    getResources() {
        let url = buildURL(API_URL, 'admin/resources')
        return axios.get(url)
            .then(res => res.data.entries)
            .catch(() => [])
    },
    toSelect(data) {
        return data.map(p => ({ text: p.name, value: p.id }))
    }
}
