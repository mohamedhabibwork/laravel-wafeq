<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Fixed()
 * @method static self Percentage()
 */
/**
 * ChargeType Enum.
 *
 * @see LaravelWafeq
 */
enum ChargeType: string
{
    case Fixed = 'FIXED';
    case Percentage = 'PERCENTAGE';
}
