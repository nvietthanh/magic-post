/* eslint-disable no-unused-vars */
import {
    MASTER_ADMIN,
    HEAD_TRANSACTION_ADMIN,
    MANAGER_TRANSACTION_ADMIN,
    HEAD_CONCENTRATE_ADMIN,
    MANAGER_CONCENTRATE_ADMIN,
} from '@/Store/Consts/roles'

export const MENUS = [
    // {
    //     label: 'Thống kê',
    //     icon: 'bi-bar-chart-line',
    //     route: 'admin.dashboard',
    //     pathActive: 'dashboard',
    //     roles: [MASTER_ADMIN]
    // },
    {
        label: 'Quản lý điểm giao dịch',
        icon: 'bi-newspaper',
        route: 'admin.transaction-point.index',
        pathActive: 'transaction-point',
        roles: [MASTER_ADMIN]
    },
    {
        label: 'Quản lý điểm tiếp nhận',
        icon: 'bi-shop',
        route: 'admin.concentrate-point.index',
        pathActive: 'concentrate-point',
        roles: [MASTER_ADMIN]
    },
    {
        label: 'Quản lý người dùng',
        icon: 'bi-person',
        route: 'admin.user.index',
        pathActive: 'user',
        roles: []
    },
    {
        label: 'Quản lý nhân viên',
        icon: 'bi-people',
        route: 'admin.account.index',
        pathActive: 'account',
        roles: [MASTER_ADMIN, HEAD_TRANSACTION_ADMIN, HEAD_CONCENTRATE_ADMIN]
    },
    {
        label: 'Quản lý đơn gửi đi',
        icon: 'bi-database-up',
        route: 'admin.transaction-order-send.index',
        pathActive: 'transaction-order-send',
        roles: [MASTER_ADMIN, MANAGER_TRANSACTION_ADMIN, HEAD_TRANSACTION_ADMIN]
    },
    {
        label: 'Quản lý đơn tiếp nhận',
        icon: 'bi-database-down',
        route: 'admin.transaction-order-receive.index',
        pathActive: 'transaction-order-receive',
        roles: [MANAGER_TRANSACTION_ADMIN, HEAD_TRANSACTION_ADMIN]
    },
    {
        label: 'Quản lý đơn gửi đi',
        icon: 'bi-database-up',
        route: 'admin.concentrate-order-send.index',
        pathActive: 'concentrate-order-send',
        roles: [MANAGER_CONCENTRATE_ADMIN, HEAD_CONCENTRATE_ADMIN]
    },
    {
        label: 'Quản lý đơn tiếp nhận',
        icon: 'bi-database-down',
        route: 'admin.concentrate-order-receive.index',
        pathActive: 'concentrate-order-receive',
        roles: [MASTER_ADMIN, MANAGER_CONCENTRATE_ADMIN, HEAD_CONCENTRATE_ADMIN]
    },
]
