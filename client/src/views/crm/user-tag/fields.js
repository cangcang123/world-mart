export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Name',
        key: 'name',
    },
    {
        label: 'Description',
        key: 'description',
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
        label: 'Tạo',
        key: 'created_at',
        readonly: true,
    },
    {
        key: 'created_by',
        readonly: true,
    },
    {
        label: 'Cập Nhật',
        key: 'modified_at',
        readonly: true,
        sortable: true,
        thStyle: {
            width: '200px'
        }
    },
    {
        key: 'modified_by',
        readonly: true,
    }
]