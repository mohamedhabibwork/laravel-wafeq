<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * Every document family exposed by the Wafeq ZATCA API.
 *
 * Standard (B2B) documents are cleared by ZATCA; simplified (B2C)
 * documents are reported and additionally support the asynchronous
 * `issue` / `bulk-issue` endpoints.
 */
enum ZatcaDocumentType: string
{
    case Invoice = 'invoices';
    case CreditNote = 'credit-notes';
    case DebitNote = 'debit-notes';
    case PrepaymentInvoice = 'prepayment-invoices';
    case SimplifiedInvoice = 'simplified-invoices';
    case SimplifiedCreditNote = 'simplified-credit-notes';
    case SimplifiedDebitNote = 'simplified-debit-notes';
    case PrepaymentSimplifiedInvoice = 'prepayment-simplified-invoices';

    /**
     * The collection path relative to the API base URL, with trailing slash.
     */
    public function path(): string
    {
        return "/zatca/{$this->value}/";
    }

    /**
     * Whether the document is a simplified (B2C) document.
     */
    public function isSimplified(): bool
    {
        return match ($this) {
            self::SimplifiedInvoice,
            self::SimplifiedCreditNote,
            self::SimplifiedDebitNote,
            self::PrepaymentSimplifiedInvoice => true,
            default => false,
        };
    }

    /**
     * Whether the document is a credit or debit note, which must reference
     * the original invoice and state an issue reason.
     */
    public function isNote(): bool
    {
        return match ($this) {
            self::CreditNote,
            self::DebitNote,
            self::SimplifiedCreditNote,
            self::SimplifiedDebitNote => true,
            default => false,
        };
    }

    /**
     * Whether the document is a prepayment (advance payment) invoice.
     */
    public function isPrepayment(): bool
    {
        return $this === self::PrepaymentInvoice || $this === self::PrepaymentSimplifiedInvoice;
    }
}
