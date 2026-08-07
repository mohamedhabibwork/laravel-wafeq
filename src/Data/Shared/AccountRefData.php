<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 */
/**
 * AccountRefData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class AccountRefData extends Data
{
    public function __construct(
        public string $id = '',
        public ?string $name = null,
    ) {}
}
