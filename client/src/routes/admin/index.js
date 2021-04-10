import AdminUsers from './users'
import AdminRoles from './roles'
import AdminSettings from './setting'
import AdminPackages from './packages'
import AdminResources from './resources'
import AdminPermissionRoles from './permission-roles'
import AdminQueues from './queue'

export default [
    ...AdminUsers,
    ...AdminRoles,
    ...AdminSettings,
    ...AdminPackages,
    ...AdminResources,
    ...AdminPermissionRoles,
    ...AdminQueues,
]
