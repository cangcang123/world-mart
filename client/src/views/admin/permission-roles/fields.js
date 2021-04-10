import role from '@/services/admin/role'
import store from '@/store'

export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        label: 'Role',
        key: 'role_id',
        sortable: true,
        type: 'select',
        options: async () => {
            if (!store.state.admin.roles.length) {
                await store.dispatch('admin/getRoles')
            }
            return role.toSelect(store.state.admin.roles)
        }
    },
    {
        key: 'resource',
        sortable: true,
        variant: 'info'
    },
    {
        key: 'permissions',
        readonly: true,
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