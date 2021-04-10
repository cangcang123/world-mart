import axios from 'axios'
import qs from 'qs'
import { buildURL } from '@/helpers/utils'
import FileSaver from 'file-saver'

const API_URL = process.env.VUE_APP_API_URL

export default class CURD {
    constructor(entry) {
        this.entry = entry
        this.buildURL = buildURL.bind(this, API_URL, this.entry)
        this.paramsSerializer = params => qs.stringify(params, { encode: false })
        this.axios = axios
    }

    list(params) {
        let url = this.buildURL()
        return axios
            .get(url, {
                params,
                paramsSerializer: this.paramsSerializer
            })
            .then(res => res.data)
    }

    find(filter) {
        let params = { filter, limit: 1}
        return this.list(params)
            .then(data => data.entries || [])
            .then(entries => entries.length ? entries[0] : null)
    }

    count() {
        let url = this.buildURL()
        return axios
            .get(url)
            .then(res => res.data)
            .catch(() => null)
    }

    export(params) {
        let url = this.buildURL('export')
        return axios
            .get(url, {
                params,
                paramsSerializer: this.paramsSerializer,
                responseType: 'arraybuffer',
            })
            .then(response => {
                // const blob = new Blob([response.data], {
                //     type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                // });
                // FileSaver.saveAs(blob, this.exportFileName || 'export.csv');
            })
    }

    detail(id) {
        let url = this.buildURL(id)
        return axios
            .get(url)
            .then(res => res.data)
            .catch(() => null)
    }

    detailByOffset(id, offset) {
        let url = this.buildURL(id, offset)
        return axios
            .get(url)
            .then(res => res.data)
            .catch(() => null)
    }

    create(data) {
        let url = this.buildURL()
        return axios.post(url, data).then(res => res.data)
    }

    delete(id) {
        if (Array.isArray(id)) return this.deleteByIds(id)
        let url = this.buildURL(id)
        return axios.delete(url).then(res => res.data)
    }

    update(id, data) {
        if (typeof id === 'object' && id.id) {
            data = Object.assign(id, data)
            id = id.id
        }

        let url = this.buildURL(id)
        return axios.patch(url, data).then(res => res.data)
    }

    deleteByIds(ids) {
        let url = this.buildURL()
        return axios.delete(url, { data: { ids } })
    }

    post(path, data) {
        let url = this.buildURL(path)
        return axios.post(url, data).then(res => res.data)
    }

    distinct(field, params = {}) {
        let url = this.buildURL('distinct', field)
        return axios.get(url, {
            params,
            paramsSerializer: this.paramsSerializer,
        }).then(res => res.data)
    }
}
