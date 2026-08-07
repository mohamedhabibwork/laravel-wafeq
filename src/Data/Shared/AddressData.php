<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property ?string $line1
 * @property ?string $line2
 * @property ?string $city
 * @property ?string $state
 * @property ?string $postalCode
 * @property ?string $country
 */
/**
 * AddressData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class AddressData extends Data
{
    public function __construct(
        public ?string $line1 = null,
        public ?string $line2 = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $postalCode = null,
        public ?string $country = null,
    ) {}
}
