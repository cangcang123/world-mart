export default [
    {
        path: '/cart',
        name: 'CartList',
        component: () => import('@/views/crm/cart/List.vue')
    },
    {
        path: '/cart/add',
        name: 'CartAdd',
        component: () => import('@/views/crm/cart/Add.vue'),
        props: true
    },
    {
        path: '/cart/edit/:id',
        name: 'CartEdit',
        component: () => import('@/views/crm/cart/Edit.vue'),
        props: true
    }
]