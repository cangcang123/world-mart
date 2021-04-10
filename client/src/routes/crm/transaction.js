export default [
    {
        path: '/transaction',
        name: 'TransactionList',
        component: () => import('@/views/crm/transaction/List.vue')
    },
    {
        path: '/transaction/add',
        name: 'TransactionAdd',
        component: () => import('@/views/crm/transaction/Add.vue'),
        props: true
    },
    {
        path: '/transaction/edit/:id',
        name: 'TransactionEdit',
        component: () => import('@/views/crm/transaction/Edit.vue'),
        props: true
    }
]