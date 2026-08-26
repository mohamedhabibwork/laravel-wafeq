<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 * @property ?string $role
 * @property ?string $email
 *
 * Lightweight reference to a Wafeq user / employee returned by nested fields
 * such as `created_by` / `modified_by` and by the Organization endpoint.
 *
 * @see LaravelWafeq
 */
class UserRefData extends Data
{
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $role = null,
        public ?string $email = null,
    ) {}
}
