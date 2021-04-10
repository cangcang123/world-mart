export default [
    {
        path: '/singer',
        name: 'SingerList',
        component: () => import('@/views/crm/singer/List.vue')
    },
    {
        path: '/singer/add',
        name: 'SingerAdd',
        component: () => import('@/views/crm/singer/Add.vue'),
        props: true
    },
    {
        path: '/singer/edit/:id',
        name: 'SingerEdit',
        component: () => import('@/views/crm/singer/Edit.vue'),
        props: true
    }
]