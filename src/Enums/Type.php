<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Customer()
 * @method static self Vendor()
 * @method static self Both()
 */
/**
 * Type Enum.
 *
 * @see LaravelWafeq
 */
enum Type: string
{
    case Customer = 'CUSTOMER';
    case Vendor = 'VENDOR';
    case Both = 'BOTH';
}
