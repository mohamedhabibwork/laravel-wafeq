<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $legalName
 * @property ?string $taxId
 * @property ?string $country
 * @property ?string $currency
 * @property ?string $timezone
 * @property ?string $logo
 * @property array<string, mixed> $extra
 */
/**
 * OrganizationData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class OrganizationData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $legalName = null,
        public ?string $taxId = null,
        public ?string $country = null,
        public ?string $currency = null,
        public ?string $timezone = null,
        public ?string $logo = null,
        public array $extra = [],
    ) {}
}
