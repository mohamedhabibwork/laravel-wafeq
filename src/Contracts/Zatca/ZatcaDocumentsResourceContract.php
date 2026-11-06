<?php

namespace HWafeq\LaravelWafeq\Contracts\Zatca;

use HWafeq\LaravelWafeq\Contracts\ResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeliveryOptionsData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDocumentPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaReportRequestData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentSummaryData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaValidationResultData;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDownloadType;
use Illuminate\Http\Client\Response;
use Spatie\LaravelData\DataCollection;

/**
 * Operations shared by every ZATCA document family (invoices, credit
 * notes, debit notes, prepayment invoices and their simplified variants).
 *
 * `$options` on report / validate are the optional top-level request keys
 * that sit next to `document`: `channels`, `language`, `metadata`,
 * `reference` and `template`. Every body can be a plain snake_case array
 * or its typed DTO; a {@see ZatcaReportRequestData} carries both the
 * document and its options, and explicit `$options` override its keys.
 */
interface ZatcaDocumentsResourceContract extends ResourceContract
{
    public function type(): ZatcaDocumentType;

    /**
     * @param  array<string, mixed>  $query  `keyword`, `status`, `page`, `page_size`, `issue_datetime_after|before`, `supply_date_after|before`.
     * @return PaginatedData<ZatcaDocumentSummaryData>
     */
    public function list(array $query = []): PaginatedData;

    public function retrieve(string $id): ZatcaDocumentData;

    /**
     * Report (simplified) or clear (standard) a document with ZATCA.
     *
     * @param  array<string, mixed>|ZatcaDocumentPayloadData|ZatcaReportRequestData  $document
     * @param  array<string, mixed>|ZatcaDeliveryOptionsData  $options
     */
    public function report(array|ZatcaDocumentPayloadData|ZatcaReportRequestData $document, array|ZatcaDeliveryOptionsData $options = []): ZatcaDocumentData;

    /**
     * Validate a document and calculate its totals without reporting it.
     *
     * @param  array<string, mixed>|ZatcaDocumentPayloadData|ZatcaReportRequestData  $document
     * @param  array<string, mixed>|ZatcaDeliveryOptionsData  $options
     */
    public function validate(array|ZatcaDocumentPayloadData|ZatcaReportRequestData $document, array|ZatcaDeliveryOptionsData $options = []): ZatcaValidationResultData;

    /**
     * Queue several documents for reporting.
     *
     * @param  array<int, array<string, mixed>|ZatcaReportRequestData>  $payloads  Full request bodies, each with a `document` key.
     * @return DataCollection<int, ZatcaDocumentSummaryData>
     */
    public function bulkReport(array $payloads): DataCollection;

    /**
     * @param  array<int, array<string, mixed>|ZatcaReportRequestData>  $payloads  Full request bodies, each with a `document` key.
     * @return DataCollection<int, ZatcaValidationResultData>
     */
    public function bulkValidate(array $payloads): DataCollection;

    /**
     * Merge metadata into the document. Set a key to `null` to remove it.
     *
     * @param  array<string, string|null>  $metadata
     */
    public function updateMetadata(string $id, array $metadata): ZatcaDocumentData;

    public function download(string $id, ZatcaDownloadType $type = ZatcaDownloadType::Pdf, bool $regenerate = false): Response;

    /**
     * Retry reporting a document whose status is `ERROR`.
     */
    public function retry(string $id): ZatcaDocumentData;

    /**
     * Deliver an existing document through the given channels (e.g. email).
     *
     * @param  array<string, mixed>|ZatcaDeliveryOptionsData  $payload  `channels`, `language`, `metadata`, `reference`, `template`.
     */
    public function send(string $id, array|ZatcaDeliveryOptionsData $payload): ZatcaDocumentData;
}
