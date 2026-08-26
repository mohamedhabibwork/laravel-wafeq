<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $email
 * @property array<string, mixed> $extra
 */
/**
 * OrganizationUserData Data Transfer Object.
 *
 * Minimal user shape embedded inside `OrganizationData.users[]`.
 * Mirrors Wafeq's `OrganizationUser` schema (id + email only).
 *
 * @see LaravelWafeq
 */
class OrganizationUserData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $email = '',
        public array $extra = [],
    ) {}
}
