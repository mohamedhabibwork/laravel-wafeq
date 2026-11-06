<?php

namespace HWafeq\LaravelWafeq\Data\Zatca;

use Spatie\LaravelData\Data;

/**
 * Identifying fields of a reported ZATCA document.
 *
 * Mirrors the `document-detail-read` / `document-list-read` schemas;
 * list responses only carry `id` and `documentNumber`.
 */
class ZatcaDocumentReferenceData extends Data
{
    public function __construct(
        public string $id = '',
        public string $documentNumber = '',
        public ?string $issueDatetime = null,
        public ?string $supplyDate = null,
    ) {}
}
