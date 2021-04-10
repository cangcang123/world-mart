export default [
    {
        path: '/user-profiles',
        name: 'UserProfileList',
        component: () => import('@/views/crm/profile/List.vue')
    },
    {
        path: '/user-profiles/edit/:id',
        name: 'UserProfileEdit',
        component: () => import('@/views/crm/profile/Edit.vue'),
        props: true
    }
]