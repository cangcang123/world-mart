import store from '@/store'
import geo from "@/services/geo"

export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Image',
        key: 'image_url',
        type: 'image'
    },
    {
        label: 'Category Name',
        key: 'name',
        sortable: true
    },
    {
        key: "parent_id",
        label: "Parent Category",
        type: 'select',
        sortable: true,
        options: async () => {
            if (!store.state.crm.category.length) {
                await store.dispatch('crm/getCategories')
            }
            return store.state.crm.category.map(p => ({ text: p.name, value: p.id }))
        },
    },
    {
        label: 'Desciption',
        key: 'description',
    },
    {
        label: 'Meta Title',
        key: 'meta_title',
    },
    {
        label: 'Meta Content',
        key: 'meta_content',
    },
    {
        label: 'Cover',
        key: 'cover_photo',
        type: 'image'
    },
    {
        label: 'Slug',
        key: 'slug',
        readonly: true,
        sortable: true
    },
    {
        label: 'Status',
        key: 'status',
        type: 'select',
        sortable: true,
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