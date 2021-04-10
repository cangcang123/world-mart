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
        label: 'User',
        key: 'user_id',
        sortable: true
    },
    {
        label: 'Mã đơn hàng',
        key: 'order_code',
        sortable: true
    },
    {
        label: 'Mã Giảm giá',
        key: 'promo_code',
        sortable: true
    },
    {
        label: 'Giảm giá',
        key: 'discount',
        sortable: true
    },
    {
        label: 'Phí ship',
        key: 'shipping_fee',
        sortable: true
    },
    {
        label: 'Tổng hoa hồng',
        key: 'bonus_fee',
        sortable: true
    },
    {
        label: 'Tổng tiền',
        key: 'grand_total',
        sortable: true
    },
    {
        label: 'Hình thức giao hàng',
        key: 'delivery_method',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'Giao hàng tiêu chuẩn'},
        ],
    },
    {
        label: 'Thanh toán',
        key: 'payment_method',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'Tiền mặt'},
        ],
    },
    {
        label: 'Nội dung đơn hàng',
        key: 'order_content',
        sortable: true
    },
    {
        label: 'Thông tin người mua',
        key: 'delivery_info',
        sortable: true
    },
    {
        label: 'Trạng thái đơn hàng',
        key: 'status',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'Chờ duyệt'},
            { value: 2, text: 'Đang giao'},
            { value: 3, text: 'Đã nhận'},
            { value: 4, text: 'Đã hủy'},
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