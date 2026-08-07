<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * Wafeq enum value.
 *
 * @method static self Vat()
 * @method static self SalesTax()
 * @method static self WithholdingTax()
 * @method static self Excise()
 * @method static self Custom()
 */
/**
 * TaxType Enum.
 *
 * @see LaravelWafeq
 */
enum TaxType: string
{
    case Vat = 'VAT';
    case SalesTax = 'SALES_TAX';
    case WithholdingTax = 'WITHHOLDING_TAX';
    case Excise = 'EXCISE';
    case Custom = 'CUSTOM';
}
