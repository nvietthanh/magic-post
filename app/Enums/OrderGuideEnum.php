<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static RETURN_IMMEDIATE
 * @method static static RETURN_BEFORE_DEADLINE
 * @method static static CALL_SENDER
 * @method static static RETURN_EXPIRED
 * @method static static CANCELLED
 * @method static static CALL_SENDER
 */
final class OrderGuideEnum extends Enum
{
    public const RETURN_IMMEDIATE = 1;
    public const RETURN_BEFORE_DEADLINE = 2;
    public const CALL_SENDER = 3;
    public const RETURN_EXPIRED = 4;
    public const CANCELLED = 5;

    public const GUIDE_ALL = [
        [
            'label' => 'Chuyển hoàn ngay',
            'value' => self::RETURN_IMMEDIATE
        ],
        [
            'label' => 'Chuyển hoàn trước ngày',
            'value' => self::RETURN_BEFORE_DEADLINE
        ],
        [
            'label' => 'Gọi cho người gửi/BC gửi',
            'value' => self::CALL_SENDER
        ],
        [
            'label' => 'Chuyển hoàn khi hết thời gian lưu trữ',
            'value' => self::RETURN_EXPIRED
        ],
        [
            'label' => 'Hủy',
            'value' => self::CANCELLED
        ],
    ];
}
