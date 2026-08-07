<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Value()
 * @method static self Percentage()
 */
/**
 * DiscountType Enum.
 *
 * @see LaravelWafeq
 */
enum DiscountType: string
{
    case Value = 'VALUE';
    case Percentage = 'PERCENTAGE';
}
