<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $type
 * @property ?string $email
 * @property ?string $phone
 * @property ?string $taxId
 * @property ?string $currency
 * @property ?string $addressLine1
 * @property ?string $addressLine2
 * @property ?string $city
 * @property ?string $state
 * @property ?string $postalCode
 * @property ?string $country
 * @property array<string, mixed> $extra
 */
/**
 * ContactData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class ContactData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $type = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $taxId = null,
        public ?string $currency = null,
        public ?string $addressLine1 = null,
        public ?string $addressLine2 = null,
        public ?string $city = null,
        public ?string $state = null,
        public ?string $postalCode = null,
        public ?string $country = null,
        public array $extra = [],
    ) {}
}
