export default [
    {
        path: '/admin/permission-role',
        name: 'PermissionRoleList',
        component: () => import('@/views/admin/permission-roles/List.vue')
    },
    {
        path: '/admin/permission-role/add',
        name: 'PermissionRoleAdd',
        component: () => import('@/views/admin/permission-roles/Add.vue')
    },
    {
        path: '/admin/permission-role/edit/:id',
        name: 'PermissionRoleEdit',
        component: () => import('@/views/admin/permission-roles/Edit.vue'),
        props: true
    },
]