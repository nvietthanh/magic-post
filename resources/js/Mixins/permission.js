import {
    MASTER_ADMIN, HEAD_TRANSACTION_ADMIN, 
    MANAGER_TRANSACTION_ADMIN, HEAD_CONCENTRATE_ADMIN, 
    MANAGER_CONCENTRATE_ADMIN,
    ROLE_HAS_MASTER, ROLE_HAS_HEAD_TRANSACTION, ROLE_HAS_HEAD_CONCENTRATE,
    ROLES 
}
from '@/Store/Consts/roles'

export default {
    getRoleName (key) {
        let relative = ROLES.find((role) => role.value == key)
    
        return relative?.label ?? ''
    },
    getRoleHasCreate() {
        let userRole = this.$page?.props?.auth?.user?.role

        if (userRole == MASTER_ADMIN) {
            return ROLE_HAS_MASTER;
        }

        if (userRole == HEAD_TRANSACTION_ADMIN) {
            return ROLE_HAS_HEAD_TRANSACTION
        }

        if (userRole == HEAD_CONCENTRATE_ADMIN) {
            return ROLE_HAS_HEAD_CONCENTRATE
        }
    },
    checkRoles(roles) {
        if (!roles || roles.length == 0) return true;

        let userRole = this.$page?.props?.auth?.user?.role

        return roles.includes(userRole)
    }
}