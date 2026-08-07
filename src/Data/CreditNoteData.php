<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $creditNoteNumber
 * @property ?string $status
 * @property ?string $total
 * @property ?string $currency
 * @property ?string $issueDate
 * @property ?string $contact
 * @property array<string, mixed> $extra
 */
/**
 * CreditNoteData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class CreditNoteData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $creditNoteNumber = null,
        public ?string $status = null,
        public ?string $total = null,
        public ?string $currency = null,
        public ?string $issueDate = null,
        public ?string $contact = null,
        public array $extra = [],
    ) {}
}
