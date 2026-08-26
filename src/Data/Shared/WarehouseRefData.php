<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 * @property ?string $code
 *
 * Lightweight reference to a Wafeq warehouse.
 *
 * @see LaravelWafeq
 */
class WarehouseRefData extends Data
{
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $code = null,
    ) {}
}
