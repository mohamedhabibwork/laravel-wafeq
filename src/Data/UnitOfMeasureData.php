<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $abbreviation
 * @property array<string, mixed> $extra
 */
/**
 * UnitOfMeasureData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class UnitOfMeasureData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $abbreviation = null,
        public array $extra = [],
    ) {}
}
