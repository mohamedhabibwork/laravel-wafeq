<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * The seller. Platforms reporting for a connected account put that
 * customer's CRN in `identification`.
 */
class ZatcaSupplierData extends ZatcaPayloadData
{
    public function __construct(
        public string $name,
        public ZatcaAddressData $address,
        public ZatcaPartyIdentificationData $identification,
    ) {}
}
