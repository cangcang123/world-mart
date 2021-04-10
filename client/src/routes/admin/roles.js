export default [
    {
        path: '/admin/roles',
        name: 'AdminRoleList',
        component: () => import('@/views/admin/roles/List.vue')
    },
    {
        path: '/admin/roles/add',
        name: 'AdminRoleAdd',
        component: () => import('@/views/admin/roles/Add.vue')
    },
    {
        path: '/admin/roles/edit/:id',
        name: 'AdminRoleEdit',
        component: () => import('@/views/admin/roles/Edit.vue'),
        props: true
    },
]