<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * TypeEnum mirrors the Wafeq `TypeEnum` schema. Used for the `type` field on
 * resources that distinguish a percentage-based vs amount-based value.
 *
 * @method static self Percent()
 * @method static self Amount()
 *
 * @see LaravelWafeq
 */
enum Type: string
{
    case Percent = 'percent';
    case Amount = 'amount';
}
