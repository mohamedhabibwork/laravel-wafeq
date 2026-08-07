<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $description
 * @property ?string $startDate
 * @property ?string $endDate
 * @property ?string $status
 * @property ?string $customer
 * @property array<string, mixed> $extra
 */
/**
 * ProjectData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class ProjectData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $description = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public ?string $status = null,
        public ?string $customer = null,
        public array $extra = [],
    ) {}
}
