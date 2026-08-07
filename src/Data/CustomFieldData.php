<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $fieldType
 * @property ?string $resourceType
 * @property bool $isRequired
 * @property array<string, mixed> $extra
 */
/**
 * CustomFieldData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class CustomFieldData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $fieldType = null,
        public ?string $resourceType = null,
        public bool $isRequired = false,
        public array $extra = [],
    ) {}
}
