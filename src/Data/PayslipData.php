<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $reference
 * @property ?string $status
 * @property ?string $total
 * @property ?string $currency
 * @property ?string $periodStart
 * @property ?string $periodEnd
 * @property ?string $employee
 * @property array<string, mixed> $extra
 */
/**
 * PayslipData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class PayslipData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $reference = null,
        public ?string $status = null,
        public ?string $total = null,
        public ?string $currency = null,
        public ?string $periodStart = null,
        public ?string $periodEnd = null,
        public ?string $employee = null,
        public array $extra = [],
    ) {}
}
