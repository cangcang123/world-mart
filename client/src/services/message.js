import axios from 'axios'
import qs from 'qs'
import { buildURL } from '@/helpers/utils'
const API_URL = process.env.VUE_APP_API_URL

export default {
    sendTestMessage(data) {
        let url = buildURL(API_URL, 'crm/zoa-broadcast-messages/send-review')
        return axios
            .post(url, data)
            .then(res => res.data)
            .catch(() => null)
    },
    estimatesTotal(oa_id, conditions) {
        let url = buildURL(API_URL, 'crm/user-profile/count')
        return axios
            .get(url, {
                params: {
                    filter: {
                        ...conditions,
                        oa_id,
                        status_follow: 1
                    }
                },
                paramsSerializer: params =>
                    qs.stringify(params, { encode: false })
            })
            .then(res => res.data)
            .catch(() => null)
    },
    estimatesTotalFollower(oa_id, zalo_gender = undefined, params = {}) {
        let url = buildURL(API_URL, 'crm/user-follow-oa/count')
        return axios.get(url, {
            params: {
                filter: {
                    oa_id,
                    zalo_gender,
                    ...params,
                    status_follow: 1,
                }
            },
            paramsSerializer: params => qs.stringify(params, { encode: false })
        })
        .then(res => res.data)
        .catch(() => null)
    },
    setupBroadcast(id, el) {
        let url = buildURL(API_URL, 'crm/zoa-broadcast-messages/setup')
        return axios
            .post(url, { id })
            .then(res => res.data)
            .catch(err => {
                if (err.response.data && err.response.data.validator) {
                    for (const key in err.response.data.validator) {
                        const arr = err.response.data.validator[key]
                        arr.forEach(message => {
                            el.$bvToast.toast(message, { title: 'Lỗi', variant: 'danger' })
                        })
                    }
                } else {
                    el.$bvToast.toast('Có lỗi xảy ra', { title: 'Lỗi', variant: 'danger' })
                }
            })
    },
    setupScheduleBroadcast(id, el) {
        let url = buildURL(API_URL, 'crm/zoa-schedule-messages/setup')
        return axios
            .post(url, { id })
            .then(res => res.data)
            .catch(err => {
                if (err.response.data && err.response.data.validator) {
                    for (const key in err.response.data.validator) {
                        const arr = err.response.data.validator[key]
                        arr.forEach(message => {
                            el.$bvToast.toast(message, { title: 'Lỗi', variant: 'danger' })
                        })
                    }
                } else {
                    el.$bvToast.toast('Có lỗi xảy ra', { title: 'Lỗi', variant: 'danger' })
                }
            })
    },
    setupAllSchedule(el) {
        let url = buildURL(API_URL, 'crm/zoa-schedule-messages/setup-all')
        return axios
            .get(url)
            .then(res => res.data)
            .catch(err => {
                if (err.response.data && err.response.data.validator) {
                    for (const key in err.response.data.validator) {
                        const arr = err.response.data.validator[key]
                        arr.forEach(message => {
                            el.$bvToast.toast(message, { title: 'Lỗi', variant: 'danger' })
                        })
                    }
                } else {
                    el.$bvToast.toast('Có lỗi xảy ra', { title: 'Lỗi', variant: 'danger' })
                }
            })
    }
}
