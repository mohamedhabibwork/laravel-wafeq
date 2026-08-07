<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $code
 * @property ?string $description
 * @property array<string, mixed> $extra
 */
/**
 * CostCenterData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class CostCenterData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $code = null,
        public ?string $description = null,
        public array $extra = [],
    ) {}
}
