<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $reference
 * @property ?string $status
 * @property ?string $total
 * @property ?string $currency
 * @property ?string $issueDate
 * @property array<string, mixed> $extra
 */
/**
 * ApiCreditNoteData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class ApiCreditNoteData extends Data
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
        public ?string $issueDate = null,
        public array $extra = [],
    ) {}
}
