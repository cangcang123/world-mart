export default [
    {
        path: '/brand',
        name: 'BrandList',
        component: () => import('@/views/crm/brand/List.vue')
    },
    {
        path: '/brand/add',
        name: 'BrandAdd',
        component: () => import('@/views/crm/brand/Add.vue'),
        props: true
    },
    {
        path: '/brand/edit/:id',
        name: 'BrandEdit',
        component: () => import('@/views/crm/brand/Edit.vue'),
        props: true
    }
]