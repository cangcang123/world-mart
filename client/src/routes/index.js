import AuthRoutes from './auth'
import Dashboard from './dashboard'
import AdminRoutes from './admin'
import CrmRoutes from './crm'
import MessageRoutes from './message'

export default [
    ...AuthRoutes,
    {
        path: '/',
        redirect: '/user-profiles',
        component: () => import('@/layouts/App/Main.vue'),
        meta: {
            requiresAuth: true
        },
        children: [
            ...Dashboard,
            ...AdminRoutes,
            ...CrmRoutes,
            ...MessageRoutes,
        ]
    }
]
