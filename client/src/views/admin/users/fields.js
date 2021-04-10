import role from '@/services/admin/role'
import store from '@/store'

export default [
    {
        key: 'id',
        readonly: true,
    },
    {
        key: 'email',
    },
    {
        key: 'username',
    },
    {
        key: 'full_name'
    },
    {
        key: 'avatar',
        type: 'image'
    },
    {
        key: 'phone'
    },
    {
        key: 'dob',
        type: 'date'
    },
    {
        key: 'gender',
        type: 'select',
        options: [
            { value: 0, text: 'Undefined' },
            { value: 1, text: 'Male' },
            { value: 2, text: 'Female' },
        ]
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
        label: 'Status',
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