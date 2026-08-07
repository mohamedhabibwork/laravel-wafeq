<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Draft()
 * @method static self Pending()
 * @method static self Approved()
 * @method static self Rejected()
 * @method static self Paid()
 * @method static self Void()
 */
/**
 * PaymentRequestStatus Enum.
 *
 * @see LaravelWafeq
 */
enum PaymentRequestStatus: string
{
    case Draft = 'DRAFT';
    case Pending = 'PENDING';
    case Approved = 'APPROVED';
    case Rejected = 'REJECTED';
    case Paid = 'PAID';
    case Void = 'VOID';
}
