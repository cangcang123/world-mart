export default [
    {
        path: '/notification',
        name: 'NotificationList',
        component: () => import('@/views/crm/notification/List.vue')
    },
    {
        path: '/notification/add',
        name: 'ProductAdd',
        component: () => import('@/views/crm/notification/Add.vue'),
        props: true
    },
    {
        path: '/notification/edit/:id',
        name: 'ProductEdit',
        component: () => import('@/views/crm/notification/Edit.vue'),
        props: true
    }
]