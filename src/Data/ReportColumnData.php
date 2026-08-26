<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $label
 * @property array<string, mixed> $metadata
 * @property array<string, mixed> $extra
 */
/**
 * ReportColumnData Data Transfer Object.
 *
 * Single column in a `/reports/*` response. Each column carries an id
 * (often a date or period key), a localised `label`, and free-form
 * metadata.
 *
 * @see LaravelWafeq
 */
class ReportColumnData extends Data
{
    /**
     * @param  array<string, mixed>  $metadata
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $label = null,
        public array $metadata = [],
        public array $extra = [],
    ) {}
}
