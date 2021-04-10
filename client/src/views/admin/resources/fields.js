import pkg from '@/services/admin/package'
import store from '@/store'

export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Package',
        key: 'package_id',
        type: 'select',
        options: async () => {
            if (!store.state.admin.packages.length) {
                await store.dispatch('admin/getPackages')
            }
            return pkg.toSelect(store.state.admin.packages)
        }
    },
    {
        key: 'name',
    },
    {
        label: 'Publish',
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
        label: 'Cập Nhật',
        key: 'modified_at',
        readonly: true,
    },
    {
        key: 'modified_by',
        readonly: true,
    }
]