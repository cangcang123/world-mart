export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Promotion Type',
        key: 'type',
        type: 'select',
        options: [
            { value: 1, text: 'Order'},
            { value: 2, text: 'Product'},
        ],
    },
    {
        label: 'User',
        key: 'user_id',
        sortable: true
    },
    {
        label: 'Product',
        key: 'product_id',
        sortable: true
    },
    {
        label: 'Mã Giảm giá',
        key: 'code',
        sortable: true
    },
    {
        label: 'Giảm giá',
        key: 'discount_value',
        sortable: true
    },
    {
        label: 'Hoa hồng tối thiểu',
        key: 'min_commission_fee',
        sortable: true
    },
    {
        label: 'Public',
        key: 'is_public',
        type: 'select',
        options: [
            { value: 1, text: 'Public'},
            { value: 2, text: 'Private'},
        ],
    },
    {
        label: 'Số lần sử dụng',
        key: 'max_use_time',
        sortable: true
    },
    {
        label: 'Ngày bắt đầu',
        key: 'start_date',
        sortable: true
    },
    {
        label: 'Ngày kết thúc',
        key: 'end_date',
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
    }
]