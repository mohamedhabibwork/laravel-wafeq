<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $invoiceNumber
 * @property ?string $status
 * @property ?string $total
 * @property ?string $currency
 * @property ?string $issueDate
 * @property ?string $contact
 * @property array<string, mixed> $extra
 */
/**
 * SimplifiedInvoiceData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $invoiceNumber = null,
        public ?string $status = null,
        public ?string $total = null,
        public ?string $currency = null,
        public ?string $issueDate = null,
        public ?string $contact = null,
        public array $extra = [],
    ) {}
}
