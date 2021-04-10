import role from '@/services/admin/role'
import store from '@/store'

export default [
    {
        label: 'Role',
        key: 'role_id',
        type: 'select',
        options: async () => {
            if (!store.state.admin.roles.length) {
                await store.dispatch('admin/getRoles')
            }
            return role.toSelect(store.state.admin.roles)
        }
    },
    {
        key: 'username',
    },
    {
        label: 'Resource',
        key: 'resource',
    },
    {
        label: 'Hoạt Động',
        key: 'action',
    },
    {
        label: 'IP',
        key: 'ip',
    },
    {
        key: 'platform',
    },
    {
        key: 'browser',
    },
    {
        key: 'user_agent',
    },
    {
        label: 'Thời Gian',
        key: 'created_at',
        readonly: true,
    }
]