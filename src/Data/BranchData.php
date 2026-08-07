<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $code
 * @property ?string $country
 * @property ?string $city
 * @property array<string, mixed> $extra
 */
/**
 * BranchData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class BranchData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $code = null,
        public ?string $country = null,
        public ?string $city = null,
        public array $extra = [],
    ) {}
}
