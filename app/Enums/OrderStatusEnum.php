<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static self PENDING_APPROVAL
 * @method static self IN_TRANSIT_TO_COLLECTION
 * @method static self ARRIVED_AT_COLLECTION
 * @method static self IN_TRANSIT_TO_COLLECTION_DESTINATION
 * @method static self ARRIVED_AT_COLLECTION_DESTINATION
 * @method static self IN_TRANSIT_TO_TRANSACTION
 * @method static self SUCCESSFUL_DELIVERY
 * @method static self UNSUCCESSFUL_DELIVERY
 */
final class OrderStatusEnum extends Enum
{
    public const PENDING_APPROVAL = 0;
    public const TRANSIT_TO_COLLECTION = 1;
    public const TRANSIT_TO_COLLECTION_DESTINATION = 2;
    public const TRANSIT_TO_TRANSACTION = 3;
    public const DELIVERED_TO_CUSTOMER = 4;
    public const RETURN_TO_TRANSACTION = 5;

    public static $statusAll = [
        [
            'label' => 'Chờ duyệt', 
            'value' => self::PENDING_APPROVAL 
        ],
        [
            'label' => 'Chuyển tới điểm tập kết', 
            'value' => self::TRANSIT_TO_COLLECTION 
        ],
        [
            'label' => 'Chuyển tới điểm tập kết đích', 
            'value' => self::TRANSIT_TO_COLLECTION_DESTINATION 
        ],
        [
            'label' => 'Chuyển tới điểm giao dịch', 
            'value' => self::TRANSIT_TO_TRANSACTION 
        ],
        [
            'label' => 'Chuyển tới khách hàng', 
            'value' => self::DELIVERED_TO_CUSTOMER 
        ],
        [
            'label' => 'Chuyển trả lại điểm giao dịch', 
            'value' => self::RETURN_TO_TRANSACTION 
        ],
    ];
}
