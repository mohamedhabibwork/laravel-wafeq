<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * Create / update body for a platform connected account.
 *
 * All fields are optional so the same DTO serves partial updates; the
 * ZATCA connected-account FormRequests enforce what create / update need.
 */
class ZatcaConnectedAccountPayloadData extends ZatcaPayloadData
{
    public function __construct(
        public ?string $name = null,
        public ?string $address = null,
        public ?string $city = null,
        public ?string $country = null,
        public ?string $businessCategory = null,
        public ?string $taxRegistrationNumber = null,
    ) {}
}
