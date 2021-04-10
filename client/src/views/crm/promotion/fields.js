import FDate from '@/filters/date'
export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Name',
        key: 'name',
        sortable: true
    },
    {
        label: 'Desciption',
        key: 'description',
    },
    {
        label: 'Desciption',
        key: 'description',
    },
    {
        key: 'start_date',
        label: 'Ngày hiệu lực',
        sortable: true,
        readonly: true,
        formatter: value => value ? FDate(value, 'DD/MM/YYYY, h:mm:ss A') : 'Not set'
    },
    {
        key: 'end_date',
        label: 'Ngày kết thúc',
        sortable: true,
        readonly: true,
        formatter: value => value ? FDate(value, 'DD/MM/YYYY, h:mm:ss A') : 'Not set'
    },
    {
        label: 'Mức giảm giá (%)',
        key: 'value',
        type: 'number',
        sortable: true,
    },
    {
        label: 'Code giảm giá',
        key: 'code',
        sortable: true,
    },
    {
        label: 'Giảm giá tối đa',
        key: 'max_discount_price',
        type: 'number',
        sortable: true,
    },
    {
        label: 'Đơn hàng tối thiểu',
        key: 'min_order_price',
        type: 'number',
        sortable: true,
    },
    {
        label: 'Note',
        key: 'note',
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
        label: 'Created Date',
        key: 'created_at',
        sortable: true,
        readonly: true,
    }
]