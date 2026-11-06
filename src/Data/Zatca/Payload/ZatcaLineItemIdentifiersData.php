<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * Buyer, seller and standard identifiers for a line item.
 */
class ZatcaLineItemIdentifiersData extends ZatcaPayloadData
{
    public function __construct(
        public ?string $customerId = null,
        public ?string $supplierId = null,
        public ?ZatcaStandardItemIdentifierData $standardId = null,
    ) {}
}
