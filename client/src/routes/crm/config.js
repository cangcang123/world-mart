export default [
    {
        path: '/configs',
        name: 'CRMConfigList',
        component: () => import('@/views/crm/config/List.vue')
    },
    {
        path: '/configs/add',
        name: 'CRMConfigAdd',
        component: () => import('@/views/crm/config/Add.vue')
    },
    {
        path: '/configs/edit/:id',
        name: 'CRMConfigEdit',
        component: () => import('@/views/crm/config/Edit.vue'),
        props: true
    },
]