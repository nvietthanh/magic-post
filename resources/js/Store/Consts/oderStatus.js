export const PENDING_APPROVAL = 0
export const TRANSIT_TO_CONCENTRATE = 1
export const TRANSIT_TO_CONCENTRATE_DESTINATION = 2
export const TRANSIT_TO_TRANSACTION_DESTINATION = 3
export const DELIVERED_TO_CUSTOMER = 4
export const RETURN_TO_TRANSACTION = 5
export const STATUS = [
    { label: 'Chờ duyệt', value: PENDING_APPROVAL },
    { label: 'Chuyển tới điểm tập kết', value: TRANSIT_TO_CONCENTRATE },
    { label: 'Chuyển tới điểm tập kết đích', value: TRANSIT_TO_CONCENTRATE_DESTINATION },
    { label: 'Chuyển tới điểm giao dịch đích', value: TRANSIT_TO_TRANSACTION_DESTINATION },
    { label: 'Chuyển tới khách hàng', value: DELIVERED_TO_CUSTOMER },
    { label: 'Chuyển trả lại điểm giao dịch', value: RETURN_TO_TRANSACTION },
]