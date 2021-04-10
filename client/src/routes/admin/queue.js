export default [
    {
        path: '/admin/queues',
        name: 'AdminQueueList',
        component: () => import('@/views/admin/queues/List.vue')
    },
]