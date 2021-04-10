export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Title',
        key: 'title',
        sortable: true
    },
    {
        label: 'Desciption',
        key: 'description',
    },
    {
        label: 'Product',
        key: 'product_id',
        sortable: true,
    },
    {
        label: 'User ID',
        key: 'user_id',
        sortable: true,
    },
    {
        label: 'User Name',
        key: 'user_name',
        sortable: true,
    },
    {
        label: 'Images',
        key: 'images',
        sortable: true,
    },
    {
        label: 'Rating',
        key: 'rating',
        sortable: true,
    },
    // {
    //     label: 'Total Like',
    //     key: 'total_like',
    //     sortable: true,
    // },
    {
        label: 'Status',
        key: 'status',
        type: 'select',
        options: [
            { value: 1, text: 'Publish'},
            { value: 2, text: 'UnPublish'}
        ],
    },
    {
        label: 'Publish Date',
        key: 'published_at',
        sortable: true,
        readonly: true,
    },
    {
        label: 'Created Date',
        key: 'created_at',
        sortable: true,
        readonly: true,
    }
]