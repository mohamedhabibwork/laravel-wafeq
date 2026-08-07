<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property ?string $account
 * @property ?string $name
 * @property ?string $total
 * @property ?string $currency
 * @property array<string, mixed> $extra
 */
/**
 * ReportRowData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class ReportRowData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public ?string $account = null,
        public ?string $name = null,
        public ?string $total = null,
        public ?string $currency = null,
        public array $extra = [],
    ) {}
}
