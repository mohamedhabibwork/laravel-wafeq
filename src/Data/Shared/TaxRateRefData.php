<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 * @property ?string $rate
 */
/**
 * TaxRateRefData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class TaxRateRefData extends Data
{
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $rate = null,
    ) {}
}
