<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use Spatie\LaravelData\Attributes\DataCollectionOf;

/**
 * One invoice line.
 *
 * ```php
 * ZatcaLineItemData::make('iPhone 15 Pro', quantity: 1, unitPrice: 4699, tax: ZatcaTaxData::standard());
 * ```
 */
class ZatcaLineItemData extends ZatcaPayloadData
{
    /**
     * @param  array<int, ZatcaChargeData>  $charges
     * @param  array<int, ZatcaDiscountData>  $discounts
     */
    public function __construct(
        public string $item,
        public string $description,
        public float $quantity,
        public float $unitPrice,
        public ZatcaTaxData $tax,
        public ?string $unitOfMeasure = null,
        public ?ZatcaLineItemIdentifiersData $identifiers = null,
        #[DataCollectionOf(ZatcaChargeData::class)]
        public array $charges = [],
        #[DataCollectionOf(ZatcaDiscountData::class)]
        public array $discounts = [],
    ) {}

    public static function make(
        string $item,
        float $quantity,
        float $unitPrice,
        ?ZatcaTaxData $tax = null,
        ?string $description = null,
        ?string $unitOfMeasure = null,
    ): self {
        return new self(
            item: $item,
            description: $description ?? $item,
            quantity: $quantity,
            unitPrice: $unitPrice,
            tax: $tax ?? ZatcaTaxData::standard(),
            unitOfMeasure: $unitOfMeasure,
        );
    }
}
