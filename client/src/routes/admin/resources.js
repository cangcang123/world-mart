export default [
    {
        path: '/admin/resources',
        name: 'AdminResourceList',
        component: () => import('@/views/admin/resources/List.vue')
    },
    {
        path: '/admin/resources/add',
        name: 'AdminResourceAdd',
        component: () => import('@/views/admin/resources/Add.vue')
    },
    {
        path: '/admin/resources/edit/:id',
        name: 'AdminResourceEdit',
        component: () => import('@/views/admin/resources/Edit.vue'),
        props: true
    },
]