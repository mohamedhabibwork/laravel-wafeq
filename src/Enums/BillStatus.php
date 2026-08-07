<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Draft()
 * @method static self Open()
 * @method static self Overdue()
 * @method static self PartiallyPaid()
 * @method static self Paid()
 * @method static self Void()
 * @method static self Unpaid()
 */
/**
 * BillStatus Enum.
 *
 * @see LaravelWafeq
 */
enum BillStatus: string
{
    case Draft = 'DRAFT';
    case Open = 'OPEN';
    case Overdue = 'OVERDUE';
    case PartiallyPaid = 'PARTIALLY_PAID';
    case Paid = 'PAID';
    case Void = 'VOID';
    case Unpaid = 'UNPAID';
}
