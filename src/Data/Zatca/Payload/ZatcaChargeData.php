<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use HWafeq\LaravelWafeq\Support\Zatca\ZatcaCodeLists;

/**
 * A charge added at document or line level.
 *
 * Give either `amount`, or `percent` with `baseAmount`. `reason` is a
 * code from {@see ZatcaCodeLists::CHARGE_REASON_CODES}.
 */
class ZatcaChargeData extends ZatcaPayloadData
{
    public function __construct(
        public string $reason,
        public ZatcaTaxData $tax,
        public ?float $amount = null,
        public ?float $percent = null,
        public ?float $baseAmount = null,
        public ?string $reasonText = null,
    ) {}
}
