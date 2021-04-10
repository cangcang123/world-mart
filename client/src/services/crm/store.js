import CURD from '@/services/curd'

class StoreService extends CURD {
    search(params) {
        let url = this.buildURL('search')
        return this.axios
            .get(url, {
                params,
                paramsSerializer: this.paramsSerializer
            })
            .then(res => res.data)
    }
}

export default new StoreService('crm/store-infos')
