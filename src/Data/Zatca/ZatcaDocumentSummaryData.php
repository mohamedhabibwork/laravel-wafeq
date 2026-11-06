<?php

namespace HWafeq\LaravelWafeq\Data\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentStatus;
use Spatie\LaravelData\Data;

/**
 * A ZATCA document as returned by list and bulk-report endpoints.
 *
 * Mirrors the Wafeq ZATCA `list` schema.
 */
class ZatcaDocumentSummaryData extends Data
{
    public function __construct(
        public ?ZatcaDocumentReferenceData $document = null,
        public string $status = '',
        public string $createdTs = '',
        public ?string $reportedTs = null,
        public ?string $sentTs = null,
    ) {}

    public function id(): string
    {
        return $this->document->id ?? '';
    }

    public function statusEnum(): ?ZatcaDocumentStatus
    {
        return ZatcaDocumentStatus::tryFrom($this->status);
    }
}
