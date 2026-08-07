<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Draft()
 * @method static self Pending()
 * @method static self Approved()
 * @method static self Paid()
 * @method static self Void()
 */
/**
 * PayslipStatus Enum.
 *
 * @see LaravelWafeq
 */
enum PayslipStatus: string
{
    case Draft = 'DRAFT';
    case Pending = 'PENDING';
    case Approved = 'APPROVED';
    case Paid = 'PAID';
    case Void = 'VOID';
}
