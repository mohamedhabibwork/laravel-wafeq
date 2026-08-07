<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $name
 * @property ?string $description
 * @property ?string $quantity
 * @property ?string $price
 * @property ?string $total
 * @property ?string $account
 * @property ?string $taxRate
 * @property array<string, mixed> $extra
 */
/**
 * DebitNoteLineItemData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class DebitNoteLineItemData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $name = null,
        public ?string $description = null,
        public ?string $quantity = null,
        public ?string $price = null,
        public ?string $total = null,
        public ?string $account = null,
        public ?string $taxRate = null,
        public array $extra = [],
    ) {}
}
