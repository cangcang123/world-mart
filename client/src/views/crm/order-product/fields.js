export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Photo',
        key: 'cover_photo',
        sortable: true
    },
    {
        label: 'Name',
        key: 'name',
        sortable: true
    },
    {
        label: 'Order ID',
        key: 'order_id',
        sortable: true
    },
    {
        label: 'Mã đơn hàng',
        key: 'order_code',
        sortable: true
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
        label: 'Tên sản phẩm',
        key: 'product_name',
        sortable: true
    },
    {
        label: 'Category',
        key: 'category',
        sortable: true
    },
    {
        label: 'Brand',
        key: 'brand',
        sortable: true
    },
    {
        label: 'Country',
        key: 'origin',
        sortable: true
    },
    {
        label: 'Số lượng',
        key: 'quantity',
        sortable: true
    },
    {
        label: 'Gía',
        key: 'price',
        sortable: true
    },
    {
        label: 'Hoa hồng',
        key: 'commission',
        sortable: true
    },
    {
        label: 'Status',
        key: 'status',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'Completed'},
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