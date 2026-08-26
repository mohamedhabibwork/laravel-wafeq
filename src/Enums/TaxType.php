<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * TaxTypeEnum mirrors the Wafeq `TaxTypeEnum` schema. Used for the `tax_type`
 * field on tax-aware resources.
 *
 * @method static self Sales()
 * @method static self Purchases()
 * @method static self ReverseCharge()
 * @method static self OutOfScope()
 *
 * @see LaravelWafeq
 */
enum TaxType: string
{
    case Sales = 'SALES';
    case Purchases = 'PURCHASES';
    case ReverseCharge = 'REVERSE_CHARGE';
    case OutOfScope = 'OUT_OF_SCOPE';
}
