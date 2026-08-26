<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 *
 * Lightweight reference to a Wafeq item. Returned by line-item endpoints that
 * point at an item without embedding the full record.
 *
 * @see LaravelWafeq
 */
class ItemRefData extends Data
{
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $code = null,
    ) {}
}
