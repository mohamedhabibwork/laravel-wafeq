<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * The buyer. All fields are optional on simplified (B2C) documents;
 * standard (B2B) documents require `name` and an address with street
 * and city. `taxRegistrationNumber` is the 15-digit VAT number.
 */
class ZatcaCustomerData extends ZatcaPayloadData
{
    public function __construct(
        public ?string $name = null,
        public ?ZatcaAddressData $address = null,
        public ?ZatcaPartyIdentificationData $identification = null,
        public ?string $taxRegistrationNumber = null,
    ) {}
}
