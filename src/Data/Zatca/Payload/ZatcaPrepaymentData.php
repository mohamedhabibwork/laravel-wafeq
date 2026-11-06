<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * A previously invoiced prepayment deducted from this document.
 *
 * `reference` is the prepayment invoice's document number.
 */
class ZatcaPrepaymentData extends ZatcaPayloadData
{
    public function __construct(
        public string $reference,
        public string $issueDatetime,
        public float $amount,
        public ZatcaTaxData $tax,
    ) {}
}
