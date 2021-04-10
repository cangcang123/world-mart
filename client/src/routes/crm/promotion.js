export default [
    {
        path: '/promotion',
        name: 'PromotionList',
        component: () => import('@/views/crm/promotion/List.vue')
    },
    {
        path: '/promotion/add',
        name: 'PromotionAdd',
        component: () => import('@/views/crm/promotion/Add.vue'),
        props: true
    },
    {
        path: '/promotion/edit/:id',
        name: 'PromotionEdit',
        component: () => import('@/views/crm/promotion/Edit.vue'),
        props: true
    }
]