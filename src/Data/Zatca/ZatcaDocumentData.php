<?php

namespace HWafeq\LaravelWafeq\Data\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentStatus;
use Spatie\LaravelData\Data;

/**
 * A ZATCA document as returned by report, issue, retrieve, retry and send.
 *
 * Mirrors the Wafeq ZATCA `detail-read` schema. `status` is kept as the
 * raw wire string so unknown future values never break hydration; use
 * {@see self::statusEnum()} for a typed view. `response` carries the
 * raw ZATCA reporting / clearance response.
 */
class ZatcaDocumentData extends Data
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public function __construct(
        public ?ZatcaDocumentReferenceData $document = null,
        public string $status = '',
        public string $reference = '',
        public string $createdTs = '',
        public ?string $reportedTs = null,
        public ?string $sentTs = null,
        public string $qrCodeData = '',
        public array $metadata = [],
        public mixed $response = null,
    ) {}

    /**
     * The document id used by retrieve, download, retry and send.
     */
    public function id(): string
    {
        return $this->document->id ?? '';
    }

    public function statusEnum(): ?ZatcaDocumentStatus
    {
        return ZatcaDocumentStatus::tryFrom($this->status);
    }

    public function isReported(): bool
    {
        return $this->statusEnum() === ZatcaDocumentStatus::Reported;
    }

    public function needsRetry(): bool
    {
        return $this->statusEnum() === ZatcaDocumentStatus::Error;
    }
}
