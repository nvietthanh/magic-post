export const MASTER_ADMIN = 'master-admin'
export const HEAD_TRANSACTION_ADMIN = 'head-of-transaction-admin'
export const MANAGER_TRANSACTION_ADMIN = 'manager-of-transaction-admin'
export const HEAD_CONCENTRATE_ADMIN = 'head-of-concentrate-admin'
export const MANAGER_CONCENTRATE_ADMIN = 'manager-of-concentrate-admin'
export const ROLES = [
    { label: 'Quản trị viên', value: MASTER_ADMIN },
    { label: 'Trưởng điểm tập kết', value: HEAD_CONCENTRATE_ADMIN },
    { label: 'Nhân viên tập kết', value: MANAGER_CONCENTRATE_ADMIN },
    { label: 'Trưởng điểm giao dịch', value: HEAD_TRANSACTION_ADMIN },
    { label: 'Nhân viên giao dịch', value: MANAGER_TRANSACTION_ADMIN },
]
export const ROLE_HAS_MASTER = [
    { label: 'Trưởng điểm tập kết', value: HEAD_CONCENTRATE_ADMIN },
    { label: 'Nhân viên tập kết', value: MANAGER_CONCENTRATE_ADMIN },
    { label: 'Trưởng điểm giao dịch', value: HEAD_TRANSACTION_ADMIN },
    { label: 'Nhân viên giao dịch', value: MANAGER_TRANSACTION_ADMIN },
]
export const ROLE_HAS_HEAD_TRANSACTION = [
    { label: 'Nhân viên giao dịch', value: MANAGER_TRANSACTION_ADMIN },
]

export const ROLE_HAS_HEAD_CONCENTRATE = [
    { label: 'Nhân viên tập kết', value: MANAGER_CONCENTRATE_ADMIN },
]