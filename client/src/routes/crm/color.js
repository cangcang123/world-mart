export default [
    {
        path: '/color',
        name: 'ColorList',
        component: () => import('@/views/crm/color/List.vue')
    },
    {
        path: '/color/add',
        name: 'ColorAdd',
        component: () => import('@/views/crm/color/Add.vue'),
        props: true
    },
    {
        path: '/color/edit/:id',
        name: 'ColorEdit',
        component: () => import('@/views/crm/color/Edit.vue'),
        props: true
    }
]