<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use HWafeq\LaravelWafeq\Support\Zatca\ZatcaCodeLists;

/**
 * A discount (allowance) applied at document or line level.
 *
 * Give either `amount`, or `percent` with `baseAmount`. `reason` is a
 * code from {@see ZatcaCodeLists::DISCOUNT_REASON_CODES}.
 */
class ZatcaDiscountData extends ZatcaPayloadData
{
    public function __construct(
        public string $reason,
        public ZatcaTaxData $tax,
        public ?float $amount = null,
        public ?float $percent = null,
        public ?float $baseAmount = null,
    ) {}
}
