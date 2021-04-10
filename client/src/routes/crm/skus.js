

export default [
    {
        path: '/skus/edit/:id',
        name: 'SkusEdit',
        component: () => import('@/views/crm/skus/Edit.vue'),
        props: true
    },
    {
        path: '/skus',
        name: 'SkusList',
        component: () => import('@/views/crm/skus/List.vue')
    },
]