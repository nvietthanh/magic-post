export const PENDING_APPROVAL = 0;
export const TRANSIT_TO_CONCENTRATE_SEND = 1;
export const TRANSIT_TO_CONCENTRATE_RECEIVE = 2;
export const TRANSIT_TO_CONCENTRATE_DESTINATION_SEND = 3;
export const TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE = 4;
export const TRANSIT_TO_TRANSACTION_DESTINATION_SEND = 5;
export const TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE = 6;
export const DELIVERED_TO_CUSTOMER_SEND = 7;
export const DELIVERED_TO_CUSTOMER_RECEIVE = 8;
export const RETURN_TO_TRANSACTION = 9;

export const GROUP = [
    {
        'label': 'Chờ duyệt đơn hàng',
        'group': 0,
        'value': [0]
    },
    {
        'label': 'Chuyển tới điểm tập kết',
        'group': 1,
        'value': [1, 2]
    },
    {
        'label': 'Chuyển tới điểm tập kết đích',
        'group': 2,
        'value': [3, 4]
    },
    {
        'label': 'Chuyển tới điểm giao dịch đích',
        'group': 3,
        'value': [5, 6]
    },
    {
        'label': 'Chuyển tới khách hàng',
        'group': 4,
        'value': [7, 8]
    },
    {
        'label': 'Chuyển trả lại điểm giao dịch',
        'group': 5,
        'value': [9]
    },
]

export const All = [
    {
        'label': 'Chờ duyệt đơn hàng',
        'value': PENDING_APPROVAL,
        'text': 'Chờ xác nhận',
        'group': 0
    },
    {
        'label': 'Chuyển tới điểm tập kết',
        'value': TRANSIT_TO_CONCENTRATE_SEND,
        'text': 'Đang gửi đến điểm tập kết',
        'group': 1
    },
    {
        'label': 'Chuyển tới điểm tập kết',
        'value': TRANSIT_TO_CONCENTRATE_RECEIVE,
        'text': 'Đến điểm tập kết',
        'group': 1
    },
    {
        'label': 'Chuyển tới điểm tập kết đích',
        'value': TRANSIT_TO_CONCENTRATE_DESTINATION_SEND,
        'text': 'Đang gửi đến điểm tập kết đích',
        'group': 2
    },
    {
        'label': 'Chuyển tới điểm tập kết đích',
        'value': TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE,
        'text': 'Đã đến điểm tập kết đích',
        'group': 2
    },
    {
        'label': 'Chuyển tới điểm giao dịch đích',
        'value': TRANSIT_TO_TRANSACTION_DESTINATION_SEND,
        'text': 'Đang gửi đến điểm giao dịch đích',
        'group': 3
    },
    {
        'label': 'Chuyển tới điểm giao dịch đích',
        'value': TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE,
        'text': 'Đã đến điểm giao dịch đích',
        'group': 3
    },
    {
        'label': 'Chuyển tới khách hàng',
        'value': DELIVERED_TO_CUSTOMER_SEND,
        'text': 'Đang gửi đến khách hàng',
        'group': 4
    },
    {
        'label': 'Chuyển tới khách hàng',
        'value': DELIVERED_TO_CUSTOMER_RECEIVE,
        'text': 'Giao hàng thành công',
        'group': 4
    },
    {
        'label': 'Chuyển trả lại điểm giao dịch',
        'value': RETURN_TO_TRANSACTION,
        'text': 'Giao hàng thất bại',
        'group': 5
    },
];
