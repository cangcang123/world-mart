export default [
    {
        path: '/admin/users',
        name: 'AdminUserList',
        component: () => import('@/views/admin/users/List.vue')
    },
    {
        path: '/admin/users/add',
        name: 'AdminUserAdd',
        component: () => import('@/views/admin/users/Add.vue')
    },
    {
        path: '/admin/users/edit/:id',
        name: 'AdminUserEdit',
        component: () => import('@/views/admin/users/Edit.vue'),
        props: true
    },
    {
        path: '/admin/users/change-pass/:id',
        name: 'AdminUserEditPass',
        component: () => import('@/views/admin/users/ChangePass.vue'),
        props: true
    },
    {
        path: '/admin/users/log-actions',
        name: 'LogsUserActionList',
        component: () => import('@/views/admin/logs-user-actions/List.vue'),
        props: true
    }
]