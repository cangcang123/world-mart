export default [
    {
        key: 'id',
        readonly: true,
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
]