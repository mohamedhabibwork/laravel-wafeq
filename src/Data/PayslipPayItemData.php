<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 * @property ?string $description
 * @property ?string $amount
 * @property ?string $currency
 * @property ?string $type
 * @property array<string, mixed> $extra
 */
/**
 * PayslipPayItemData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class PayslipPayItemData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $description = null,
        public ?string $amount = null,
        public ?string $currency = null,
        public ?string $type = null,
        public array $extra = [],
    ) {}
}
