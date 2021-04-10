export default [
    {
        path: '/category',
        name: 'CategoryList',
        component: () => import('@/views/crm/category/List.vue')
    },
    {
        path: '/category/add',
        name: 'CategoryAdd',
        component: () => import('@/views/crm/category/Add.vue'),
        props: true
    },
    {
        path: '/category/edit/:id',
        name: 'CategoryEdit',
        component: () => import('@/views/crm/category/Edit.vue'),
        props: true
    }
]