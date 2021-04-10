export default [
    {
        path: '/',
        component: () => import('@/layouts/Auth'),
        children: [
            {
                path: 'login',
                name: 'Login',
                component: () => import('@/views/auth/Login')
            }
        ]
    }
]