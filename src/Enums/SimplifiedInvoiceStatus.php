<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Draft()
 * @method static self Open()
 * @method static self Paid()
 * @method static self Overdue()
 * @method static self PartiallyPaid()
 * @method static self Void()
 */
/**
 * SimplifiedInvoiceStatus Enum.
 *
 * @see LaravelWafeq
 */
enum SimplifiedInvoiceStatus: string
{
    case Draft = 'DRAFT';
    case Open = 'OPEN';
    case Paid = 'PAID';
    case Overdue = 'OVERDUE';
    case PartiallyPaid = 'PARTIALLY_PAID';
    case Void = 'VOID';
}
