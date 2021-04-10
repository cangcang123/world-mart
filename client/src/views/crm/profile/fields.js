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
        label: 'Họ & Tên',
        key: 'full_name',
        sortable: true
    },
    {
        label: 'Ngày sinh',
        key: 'dob',
        type: 'date',
        onInputFormat: value => value && moment(value).format('YYYY-MM-DD')
    },
    {
        label: 'Giới tính',
        key: 'gender',
        type: 'select',
        options: async () => store.state.crm.genders
    },
    {
        label: 'Số điện thoại',
        key: 'phone',
        readonly: true,
    },
    {
        label: 'Email',
        key: 'email',
    },
    {
        label: 'Địa chỉ',
        key: 'address',
    },
    {
        label: 'Referral Code',
        key: 'referral_code',
        sortable: true
    },
    {
        label: 'Referral User',
        key: 'referral_user',
        sortable: true
    },
    {
        label: 'User invited',
        key: 'user_invited',
        sortable: true
    },
    {
        label: 'Status',
        key: 'status',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'On'},
            { value: 2, text: 'Off'}
        ],
    },
    {
        label: 'Ngày tạo',
        key: 'created_at',
        readonly: true,
    },
    {
        label: 'Người tạo',
        key: 'created_by',
        readonly: true,
    },
    {
        label: 'Ngày sửa',
        key: 'modified_at',
        readonly: true,
        sortable: true,
    },
    {
        label: 'Người sửa',
        key: 'modified_by',
        readonly: true,
    },
    {
        label: 'Thông tin ngân hàng',
        key: 'banking_info',
        sortable: true
    },
    {
        label: 'CMND',
        key: 'identification',
        sortable: true
    },
]