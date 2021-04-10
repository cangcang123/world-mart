export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Color Name',
        key: 'name',
        sortable: true
    },
    {
        label: 'Desciption',
        key: 'description',
    },
    {
        label: 'Color',
        key: 'color_code',
        sortable: true,
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