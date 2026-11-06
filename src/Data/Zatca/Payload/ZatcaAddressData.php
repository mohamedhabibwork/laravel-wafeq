<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * A Saudi national address (or a foreign address for customers).
 *
 * Supplier addresses require street, building, city, district and postal
 * code; standard (B2B) customers require street and city.
 */
class ZatcaAddressData extends ZatcaPayloadData
{
    public function __construct(
        public string $country = 'SA',
        public ?string $street = null,
        public ?string $building = null,
        public ?string $city = null,
        public ?string $district = null,
        public ?string $postalCode = null,
        public ?string $additionalStreet = null,
        public ?string $province = null,
    ) {}
}
