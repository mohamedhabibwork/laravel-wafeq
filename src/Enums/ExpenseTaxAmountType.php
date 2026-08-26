<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * ExpenseTaxAmountTypeEnum mirrors the Wafeq `ExpenseTaxAmountTypeEnum`
 * schema. Used for the `tax_amount_type` field on expense line items.
 *
 * @method static self TaxExclusive()
 * @method static self TaxInclusive()
 *
 * @see LaravelWafeq
 */
enum ExpenseTaxAmountType: string
{
    case TaxExclusive = 'TAX_EXCLUSIVE';
    case TaxInclusive = 'TAX_INCLUSIVE';
}
