<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $invoiceNumber
 * @property ?string $status
 * @property ?string $total
 * @property ?string $amountDue
 * @property ?string $currency
 * @property ?string $issueDate
 * @property ?string $dueDate
 * @property ?string $contact
 * @property ?string $taxAmountType
 * @property array<string, mixed> $extra
 */
/**
 * InvoiceData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class InvoiceData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $invoiceNumber = null,
        public ?string $status = null,
        public ?string $total = null,
        public ?string $amountDue = null,
        public ?string $currency = null,
        public ?string $issueDate = null,
        public ?string $dueDate = null,
        public ?string $contact = null,
        public ?string $taxAmountType = null,
        public array $extra = [],
    ) {}
}
