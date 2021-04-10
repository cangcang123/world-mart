export default [
    {
        path: '/order',
        name: 'OrderList',
        component: () => import('@/views/crm/order/List.vue')
    },
    {
        path: '/order/edit/:id',
        name: 'OrderEdit',
        component: () => import('@/views/crm/order/Edit.vue'),
        props: true
    },
]