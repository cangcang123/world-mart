import store from '@/store'
import geo from "@/services/geo"

export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Logo',
        key: 'logo',
        type: 'image'
    },
    {
        label: 'Brand Name',
        key: 'name',
        sortable: true
    },
    {
        label: 'Desciption',
        key: 'description',
    },
    {
        label: 'Nhà phân phối',
        key: 'distributor',
    },
    {
        label: 'Country',
        key: 'country',
        type: 'select',
        sortable: true,
        options: async () => {
            if (!store.state.crm.countries.length) {
                await store.dispatch('crm/getCountries')
            }
            return geo.geoToSelectCountry(store.state.crm.countries)
        }
    },
    {
        label: 'Slug',
        key: 'slug',
        readonly: true,
    },
    {
        label: 'Status',
        key: 'status',
        type: 'select',
        sortable: true,
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'On'},
            { value: 2, text: 'Off'}
        ],
    },
    {
        label: 'Created Date',
        key: 'created_at',
        sortable: true,
        readonly: true,
    }
]