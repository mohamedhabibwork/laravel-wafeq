<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * TaxAmountType8abEnum mirrors the Wafeq `TaxAmountType8abEnum` schema. Used
 * for the `tax_amount_type` field on tax-aware resources.
 *
 * @method static self TaxInclusive()
 * @method static self TaxExclusive()
 *
 * @see LaravelWafeq
 */
enum TaxAmountType8ab: string
{
    case TaxInclusive = 'TAX_INCLUSIVE';
    case TaxExclusive = 'TAX_EXCLUSIVE';
}
