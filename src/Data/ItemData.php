<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $sku
 * @property ?string $description
 * @property ?string $type
 * @property ?string $unitPrice
 * @property ?string $currency
 * @property ?string $purchasePrice
 * @property ?string $purchaseAccount
 * @property ?string $salesAccount
 * @property ?string $inventoryAccount
 * @property array<string, mixed> $extra
 */
/**
 * ItemData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class ItemData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $sku = null,
        public ?string $description = null,
        public ?string $type = null,
        public ?string $unitPrice = null,
        public ?string $currency = null,
        public ?string $purchasePrice = null,
        public ?string $purchaseAccount = null,
        public ?string $salesAccount = null,
        public ?string $inventoryAccount = null,
        public array $extra = [],
    ) {}
}
