import geo from "@/services/geo"
import store from '@/store'
import moment from 'moment'
import CURD from '@/services/curd'

const UserProfileService = new CURD('crm/user-profile')

export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Zalo OA',
        key: 'oa_id',
        type: 'select',
        options: async () => {
            if (!store.state.crm.officialAccounts.length) {
                await store.dispatch('crm/getListOA')
            }
            return store.state.crm.officialAccounts.map(o => ({ text: o.name, value: o.oa_id}))
        }
    },
    {
        label: 'Zalo ID App',
        key: 'zalo_id_by_app',
    },
    {
        label: 'Zalo ID',
        key: 'zalo_id_by_oa',
    },
    {
        label: 'Zalo Name',
        key: 'zalo_name',
    },
    {
        label: 'Nhà phân phối',
        key: 'distributor',
    },
    {
        label: 'Điểm bán',
        key: 'sale_point',
    },
    {
        label: 'Loại điểm bán',
        key: 'sale_point_type',
    },
    {
        label: 'Full Name',
        key: 'full_name',
        sortable: true
    },
    {
        label: 'Date of Birth',
        key: 'dob',
        type: 'date',
        onInputFormat: value => value && moment(value).format('YYYY-MM-DD')
    },
    {
        label: 'Gender',
        key: 'gender',
        type: 'select',
        options: async () => store.state.crm.genders
    },
    {
        label: 'Phone',
        key: 'phone',
        readonly: true,
    },
    {
        label: 'Email',
        key: 'email',
    },
    {
        label: 'Address',
        key: 'address',
    },
    // {
    //     label: 'Province',
    //     key: 'province_code',
    //     type: 'select',
    //     options: async () => {
    //         if (!store.state.crm.provinces.length) {
    //             await store.dispatch('crm/getProvinces')
    //         }
    //         return geo.geoToSelect(store.state.crm.provinces)
    //     }
    // },
    {
        label: 'Province',
        key: 'province',
        sortable: true,
    },
    // {
    //     label: 'Quận/Huyện',
    //     key: 'district_code',
    //     type: 'select',
    //     options: []
    // },
    // {
    //     label: 'Xã/Phường',
    //     key: 'ward_code',
    //     type: 'select',
    //     options: []
    // },
    {
        label: 'Quận',
        key: 'district'
    },
    {
        label: 'Huyện',
        key: 'ward'
    },
    {
        label: 'Follow',
        key: 'status_follow',
        type: 'select',
        readonly: true,
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'Follow'},
            { value: 2, text: 'Not Follow'},
            { value: 3, text: 'No Zalo'},
            { value: 4, text: 'Invalid Phone Number'},
        ]
    },
    {
        label: 'Status',
        key: 'status',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'Active'},
            { value: 2, text: 'InActive'}
        ],
        thClass: 'text-center',
        tdClass: 'text-center',
        thStyle: {
            width: '120px'
        }
    },
    {
        label: 'Created At',
        key: 'created_at',
        readonly: true,
    },
    {
        label: 'Created By',
        key: 'created_by',
        readonly: true,
    },
    {
        label: 'Modified At',
        key: 'modified_at',
        readonly: true,
        sortable: true,
    },
    {
        label: 'Modified By',
        key: 'modified_by',
        readonly: true,
    }
]