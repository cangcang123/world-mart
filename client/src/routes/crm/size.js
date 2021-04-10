export default [
    {
        path: '/size',
        name: 'SizeList',
        component: () => import('@/views/crm/size/List.vue')
    },
    {
        path: '/size/add',
        name: 'SizeAdd',
        component: () => import('@/views/crm/size/Add.vue'),
        props: true
    },
    {
        path: '/size/edit/:id',
        name: 'SizeEdit',
        component: () => import('@/views/crm/size/Edit.vue'),
        props: true
    }
]