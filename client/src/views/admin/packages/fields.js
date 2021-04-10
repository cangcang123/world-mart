export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        key: 'name',
    },
    {
        key: 'is_publish',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined' },
            { value: 1, text: 'Published' },
            { value: 2, text: 'Unpublished' },
        ]
    },
    {
        key: 'state'
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
        key: 'created_at',
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