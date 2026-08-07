<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 */
/**
 * ContactRefData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class ContactRefData extends Data
{
    public function __construct(
        public string $id = '',
        public ?string $name = null,
    ) {}
}
