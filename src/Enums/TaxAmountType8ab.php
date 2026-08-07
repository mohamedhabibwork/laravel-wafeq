<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self TaxInclusive()
 * @method static self TaxExclusive()
 * @method static self NoTax()
 */
/**
 * TaxAmountType8ab Enum.
 *
 * @see LaravelWafeq
 */
enum TaxAmountType8ab: string
{
    case TaxInclusive = 'TAX_INCLUSIVE';
    case TaxExclusive = 'TAX_EXCLUSIVE';
    case NoTax = 'NO_TAX';
}
