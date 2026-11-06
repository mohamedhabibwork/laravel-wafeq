<?php

namespace HWafeq\LaravelWafeq\Data\Zatca;

use Spatie\LaravelData\Data;

/**
 * The result of validating a ZATCA document without reporting it.
 *
 * Mirrors the Wafeq ZATCA `document-validation-read` schema, carrying the
 * totals Wafeq calculated from the submitted line items.
 */
class ZatcaValidationResultData extends Data
{
    /**
     * @param  array<int, mixed>  $channels
     * @param  array<string, mixed>|null  $customer
     */
    public function __construct(
        public string $documentNumber = '',
        public ?string $issueDatetime = null,
        public string $currency = '',
        public ?array $customer = null,
        public array $channels = [],
        public float|int|string|null $providedTaxTotal = null,
        public ?float $calculatedPayableAmountGross = null,
        public ?float $calculatedPayableAmountNet = null,
        public ?float $calculatedPayableAmountTax = null,
        public ?float $calculatedPrepaidAmountGross = null,
        public ?float $calculatedPrepaidAmountNet = null,
        public ?float $calculatedPrepaidAmountTax = null,
        public ?float $calculatedTotalAmountGross = null,
        public ?float $calculatedTotalAmountNet = null,
        public ?float $calculatedTotalAmountTax = null,
    ) {}
}
