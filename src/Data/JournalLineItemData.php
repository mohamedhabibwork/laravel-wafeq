<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $account
 * @property ?string $description
 * @property ?string $debit
 * @property ?string $credit
 * @property ?string $currency
 * @property array<string, mixed> $extra
 */
/**
 * JournalLineItemData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class JournalLineItemData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $account = null,
        public ?string $description = null,
        public ?string $debit = null,
        public ?string $credit = null,
        public ?string $currency = null,
        public array $extra = [],
    ) {}
}
