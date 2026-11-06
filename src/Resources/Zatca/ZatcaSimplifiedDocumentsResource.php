<?php

namespace HWafeq\LaravelWafeq\Resources\Zatca;

use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaSimplifiedDocumentsResourceContract;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeliveryOptionsData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDocumentPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaReportRequestData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentData;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Events\Zatca\ZatcaDocumentIssued;
use HWafeq\LaravelWafeq\Exceptions\ZatcaConfigurationException;
use Illuminate\Http\Client\PendingRequest;
use Spatie\LaravelData\DataCollection;

/**
 * A simplified (B2C) ZATCA document family. Adds `issue` / `bulkIssue`.
 *
 * @see https://docs.wafeq.com/zatca/for-b2c
 * @see LaravelWafeq
 */
class ZatcaSimplifiedDocumentsResource extends ZatcaDocumentsResource implements ZatcaSimplifiedDocumentsResourceContract
{
    public function __construct(PendingRequest $http, ZatcaDocumentType $type)
    {
        if (! $type->isSimplified()) {
            throw new ZatcaConfigurationException("ZATCA document type [{$type->value}] does not support issuing.");
        }

        parent::__construct($http, $type);
    }

    public function issue(array|ZatcaDocumentPayloadData|ZatcaReportRequestData $document, array|ZatcaDeliveryOptionsData $options = []): ZatcaDocumentData
    {
        $payload = $this->payload($document, $options);

        $data = $this->toData($this->http->post($this->path('issue/'), $payload), ZatcaDocumentData::class);

        event(new ZatcaDocumentIssued($data, $data->id(), $payload));

        return $data;
    }

    public function bulkIssue(array $payloads): DataCollection
    {
        $response = $this->http->post($this->path('bulk-issue/'), $this->toWireList($payloads));

        return $this->toCollection($response, ZatcaDocumentData::class);
    }
}
