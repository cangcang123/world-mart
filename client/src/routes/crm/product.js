export default [
    {
        path: '/product',
        name: 'ProductList',
        component: () => import('@/views/crm/product/List.vue')
    },
    {
        path: '/product/add',
        name: 'ProductAdd',
        component: () => import('@/views/crm/product/Add.vue'),
        props: true
    },
    {
        path: '/product/edit/:id',
        name: 'ProductEdit',
        component: () => import('@/views/crm/product/Edit.vue'),
        props: true
    },
    {
        path: '/product/sku/add/:id',
        name: 'ProductSkuAdd',
        component: () => import('@/views/crm/product/ProductSkuAdd.vue'),
        props: true
    }
]