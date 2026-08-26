<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * DiscountTypeEnum mirrors the Wafeq `DiscountTypeEnum` schema. Used for the
 * `discount_type` field on discount-aware resources.
 *
 * @method static self Percent()
 * @method static self Amount()
 *
 * @see LaravelWafeq
 */
enum DiscountType: string
{
    case Percent = 'percent';
    case Amount = 'amount';
}
