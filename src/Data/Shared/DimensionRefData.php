<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 * @property ?string $code
 *
 * Lightweight reference to a Wafeq cost center or project. Returned by line
 * items and many nested properties that point at a dimension without
 * embedding the full record.
 *
 * @see LaravelWafeq
 */
class DimensionRefData extends Data
{
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $code = null,
    ) {}
}
