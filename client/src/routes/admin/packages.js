export default [
    {
        path: '/admin/packages',
        name: 'AdminPackageList',
        component: () => import('@/views/admin/packages/List.vue')
    },
    {
        path: '/admin/packages/add',
        name: 'AdminPackageAdd',
        component: () => import('@/views/admin/packages/Add.vue')
    },
    {
        path: '/admin/packages/edit/:id',
        name: 'AdminPackageEdit',
        component: () => import('@/views/admin/packages/Edit.vue'),
        props: true
    },
]