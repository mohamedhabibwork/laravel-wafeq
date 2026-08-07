<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $billNumber
 * @property ?string $status
 * @property ?string $total
 * @property ?string $amountDue
 * @property ?string $currency
 * @property ?string $issueDate
 * @property ?string $dueDate
 * @property ?string $vendor
 * @property array<string, mixed> $extra
 */
/**
 * BillData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class BillData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $billNumber = null,
        public ?string $status = null,
        public ?string $total = null,
        public ?string $amountDue = null,
        public ?string $currency = null,
        public ?string $issueDate = null,
        public ?string $dueDate = null,
        public ?string $vendor = null,
        public array $extra = [],
    ) {}
}
