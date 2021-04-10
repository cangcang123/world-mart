export default [
    {
        path: '/user-tags',
        name: 'UserTagList',
        component: () => import('@/views/crm/user-tag/List.vue')
    },
    {
        path: '/user-tags/add',
        name: 'UserTagAdd',
        component: () => import('@/views/crm/user-tag/Add.vue')
    },
    {
        path: '/user-tags/edit/:id',
        name: 'UserTagEdit',
        component: () => import('@/views/crm/user-tag/Edit.vue'),
        props: true
    },
]