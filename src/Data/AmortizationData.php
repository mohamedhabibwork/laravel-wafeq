<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 * @property ?string $status
 * @property ?string $totalAmount
 * @property ?string $currency
 * @property ?string $startDate
 * @property ?string $endDate
 * @property array<int, array<string, mixed>> $schedule
 * @property array<string, mixed> $extra
 */
/**
 * AmortizationData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class AmortizationData extends Data
{
    /**
     * @param  array<int, array<string, mixed>>  $schedule
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $status = null,
        public ?string $totalAmount = null,
        public ?string $currency = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public array $schedule = [],
        public array $extra = [],
    ) {}
}
