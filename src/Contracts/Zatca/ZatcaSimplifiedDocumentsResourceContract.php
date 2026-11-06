<?php

namespace HWafeq\LaravelWafeq\Contracts\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeliveryOptionsData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDocumentPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaReportRequestData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentData;
use Spatie\LaravelData\DataCollection;

/**
 * Simplified (B2C) documents additionally support asynchronous issuing:
 * the signed XML and QR code are returned immediately (202) and reporting
 * to ZATCA is queued.
 *
 * @see https://docs.wafeq.com/zatca/for-b2c
 */
interface ZatcaSimplifiedDocumentsResourceContract extends ZatcaDocumentsResourceContract
{
    /**
     * @param  array<string, mixed>|ZatcaDocumentPayloadData|ZatcaReportRequestData  $document
     * @param  array<string, mixed>|ZatcaDeliveryOptionsData  $options
     */
    public function issue(array|ZatcaDocumentPayloadData|ZatcaReportRequestData $document, array|ZatcaDeliveryOptionsData $options = []): ZatcaDocumentData;

    /**
     * @param  array<int, array<string, mixed>|ZatcaReportRequestData>  $payloads  Full request bodies, each with a `document` key.
     * @return DataCollection<int, ZatcaDocumentData>
     */
    public function bulkIssue(array $payloads): DataCollection;
}
