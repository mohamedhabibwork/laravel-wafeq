<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $poNumber
 * @property ?string $status
 * @property ?string $total
 * @property ?string $currency
 * @property ?string $issueDate
 * @property ?string $deliveryDate
 * @property ?string $vendor
 * @property array<string, mixed> $extra
 */
/**
 * PurchaseOrderData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class PurchaseOrderData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $poNumber = null,
        public ?string $status = null,
        public ?string $total = null,
        public ?string $currency = null,
        public ?string $issueDate = null,
        public ?string $deliveryDate = null,
        public ?string $vendor = null,
        public array $extra = [],
    ) {}
}
