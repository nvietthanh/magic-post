<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static MASTER_ADMIN
 * @method static static HEAD_TRANSACTION_ADMIN
 * @method static static MANAGER_TRANSACTION_ADMIN
 * @method static static HEAD_CONCENTRATE_ADMIN
 * @method static static MANAGER_CONCENTRATE_ADMIN
 * @method static static All
 */
final class AdminRoleEnum extends Enum
{
    public const MASTER_ADMIN = 'master-admin';
    public const HEAD_TRANSACTION_ADMIN = 'head-of-transaction-admin';
    public const MANAGER_TRANSACTION_ADMIN = 'manager-of-transaction-admin';
    public const HEAD_CONCENTRATE_ADMIN = 'head-of-concentrate-admin';
    public const MANAGER_CONCENTRATE_ADMIN = 'manager-of-concentrate-admin';
    public const All = [
        'head-of-transaction-admin', 'manager-of-transaction-admin',
        'head-of-concentrate-admin', 'manager-of-concentrate-admin'
    ];
}
