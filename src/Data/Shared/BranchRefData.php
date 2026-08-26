<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 *
 * Lightweight reference to a Wafeq branch.
 *
 * @see LaravelWafeq
 */
class BranchRefData extends Data
{
    public function __construct(
        public string $id = '',
        public ?string $name = null,
    ) {}
}
