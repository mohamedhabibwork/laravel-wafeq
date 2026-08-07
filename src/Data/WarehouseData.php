<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $code
 * @property ?string $addressLine1
 * @property ?string $city
 * @property ?string $country
 * @property array<string, mixed> $extra
 */
/**
 * WarehouseData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class WarehouseData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $code = null,
        public ?string $addressLine1 = null,
        public ?string $city = null,
        public ?string $country = null,
        public array $extra = [],
    ) {}
}
