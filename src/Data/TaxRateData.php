<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $rate
 * @property ?string $taxType
 * @property ?string $country
 * @property array<string, mixed> $extra
 */
/**
 * TaxRateData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class TaxRateData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $rate = null,
        public ?string $taxType = null,
        public ?string $country = null,
        public array $extra = [],
    ) {}
}
