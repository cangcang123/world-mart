export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        key: 'name',
    },
    {
        key: 'description',
    },
    {
        key: 'key',
    },
    {
        key: 'value',
    },
    {
        key: 'status',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined'},
            { value: 1, text: 'Active'},
            { value: 2, text: 'Inactive'},
        ]
    },
    {
        key: 'status_log',
        readonly: true,
    },
    {
        key: 'created_at',
        readonly: true,
    },
    {
        key: 'created_by',
        readonly: true,
    },
    {
        key: 'modified_at',
        readonly: true,
    },
    {
        key: 'modified_by',
        readonly: true,
    }
]