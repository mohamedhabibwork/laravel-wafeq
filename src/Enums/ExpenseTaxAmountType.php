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
 * ExpenseTaxAmountType Enum.
 *
 * @see LaravelWafeq
 */
enum ExpenseTaxAmountType: string
{
    case TaxInclusive = 'TAX_INCLUSIVE';
    case TaxExclusive = 'TAX_EXCLUSIVE';
    case NoTax = 'NO_TAX';
}
