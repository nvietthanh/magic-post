<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static self PENDING_APPROVAL
 * @method static self IN_TRANSIT_TO_CONCENTRATE
 * @method static self ARRIVED_AT_CONCENTRATE
 * @method static self IN_TRANSIT_TO_CONCENTRATE_DESTINATION
 * @method static self ARRIVED_AT_CONCENTRATE_DESTINATION
 * @method static self IN_TRANSIT_TO_TRANSACTION
 * @method static self SUCCESSFUL_DELIVERY
 * @method static self UNSUCCESSFUL_DELIVERY
 */
final class OrderStatusEnum extends Enum
{
    public const PENDING_APPROVAL = 0;
    public const TRANSIT_TO_CONCENTRATE_SEND = 1;
    public const TRANSIT_TO_CONCENTRATE_RECEIVE = 2;
    public const TRANSIT_TO_CONCENTRATE_DESTINATION_SEND = 3;
    public const TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE = 4;
    public const TRANSIT_TO_TRANSACTION_DESTINATION_SEND = 5;
    public const TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE = 6;
    public const DELIVERED_TO_CUSTOMER_SEND = 7;
    public const DELIVERED_TO_CUSTOMER_RECEIVE = 8;
    public const RETURN_TO_TRANSACTION = 9;

    public const All = [
        [
            'label' => 'Chờ duyệt đơn hàng', 
            'value' => self::PENDING_APPROVAL,
            'text' => 'Chờ xác nhận',
            'group' => 0
        ],
        [
            'label' => 'Chuyển tới điểm tập kết', 
            'value' => self::TRANSIT_TO_CONCENTRATE_SEND,
            'text' => 'Đang gửi đến điểm tập kết',
            'group' => 1
        ],
        [
            'label' => 'Chuyển tới điểm tập kết', 
            'value' => self::TRANSIT_TO_CONCENTRATE_RECEIVE,
            'text' => 'Đến điểm tập kết',
            'group' => 1
        ],
        [
            'label' => 'Chuyển tới điểm tập kết đích', 
            'value' => self::TRANSIT_TO_CONCENTRATE_DESTINATION_SEND,
            'text' => 'Đang gửi đến điểm tập kết đích',
            'group' => 2
        ],
        [
            'label' => 'Chuyển tới điểm tập kết đích', 
            'value' => self::TRANSIT_TO_CONCENTRATE_DESTINATION_RECEIVE,
            'text' => 'Đã đến điểm tập kết đích',
            'group' => 2
        ],
        [
            'label' => 'Chuyển tới điểm giao dịch đích',
            'value' => self::TRANSIT_TO_TRANSACTION_DESTINATION_SEND,
            'text' => 'Đang gửi đến điểm giao dịch đích',
            'group' => 3
        ],
        [
            'label' => 'Chuyển tới điểm giao dịch đích',
            'value' => self::TRANSIT_TO_TRANSACTION_DESTINATION_RECEIVE,
            'text' => 'Đã đến điểm giao dịch đích',
            'group' => 3
        ],
        [
            'label' => 'Chuyển tới khách hàng',
            'value' => self::DELIVERED_TO_CUSTOMER_SEND,
            'text' => 'Đang gửi đến khách hàng',
            'group' => 4
        ],
        [
            'label' => 'Chuyển tới khách hàng',
            'value' => self::DELIVERED_TO_CUSTOMER_RECEIVE,
            'text' => 'Giao hàng thành công',
            'group' => 4
        ],
        [
            'label' => 'Chuyển trả lại điểm giao dịch', 
            'value' => self::RETURN_TO_TRANSACTION,
            'text' => 'Giao hàng thất bại',
            'group' => 5
        ],
    ];
}
