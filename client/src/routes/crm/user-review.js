export default [
    {
        path: '/user-review',
        name: 'UserReviewList',
        component: () => import('@/views/crm/user-review/List.vue')
    },
    {
        path: '/user-review/add',
        name: 'UserReviewAdd',
        component: () => import('@/views/crm/user-review/Add.vue'),
        props: true
    },
    {
        path: '/user-review/edit/:id',
        name: 'UserReviewEdit',
        component: () => import('@/views/crm/user-review/Edit.vue'),
        props: true
    }
]