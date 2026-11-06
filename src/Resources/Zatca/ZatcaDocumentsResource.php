<?php

namespace HWafeq\LaravelWafeq\Resources\Zatca;

use HWafeq\LaravelWafeq\Concerns\Zatca\HandlesZatcaResponses;
use HWafeq\LaravelWafeq\Concerns\Zatca\NormalizesZatcaPayloads;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaDocumentsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeliveryOptionsData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDocumentPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaReportRequestData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentSummaryData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaValidationResultData;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDownloadType;
use HWafeq\LaravelWafeq\Events\Zatca\ZatcaDocumentReported;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Spatie\LaravelData\DataCollection;

/**
 * One ZATCA document family, selected by {@see ZatcaDocumentType}.
 *
 * Standard documents (B2B invoices, credit / debit notes, prepayment
 * invoices) are cleared synchronously by `report`.
 *
 * @see https://docs.wafeq.com/zatca/for-b2b
 * @see LaravelWafeq
 */
class ZatcaDocumentsResource implements ZatcaDocumentsResourceContract
{
    use HandlesZatcaResponses;
    use NormalizesZatcaPayloads;

    public function __construct(
        protected readonly PendingRequest $http,
        protected readonly ZatcaDocumentType $type,
    ) {}

    public function type(): ZatcaDocumentType
    {
        return $this->type;
    }

    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get($this->path(), $query), ZatcaDocumentSummaryData::class);
    }

    public function retrieve(string $id): ZatcaDocumentData
    {
        return $this->toData($this->http->get($this->path("{$id}/")), ZatcaDocumentData::class);
    }

    public function report(array|ZatcaDocumentPayloadData|ZatcaReportRequestData $document, array|ZatcaDeliveryOptionsData $options = []): ZatcaDocumentData
    {
        $payload = $this->payload($document, $options);

        $data = $this->toData($this->http->post($this->path('report/'), $payload), ZatcaDocumentData::class);

        event(new ZatcaDocumentReported($data, $data->id(), $payload));

        return $data;
    }

    public function validate(array|ZatcaDocumentPayloadData|ZatcaReportRequestData $document, array|ZatcaDeliveryOptionsData $options = []): ZatcaValidationResultData
    {
        $response = $this->http->post($this->path('validate/'), $this->payload($document, $options));

        return $this->toData($response, ZatcaValidationResultData::class);
    }

    public function bulkReport(array $payloads): DataCollection
    {
        $response = $this->http->post($this->path('bulk-report/'), $this->toWireList($payloads));

        return $this->toCollection($response, ZatcaDocumentSummaryData::class);
    }

    public function bulkValidate(array $payloads): DataCollection
    {
        $response = $this->http->post($this->path('bulk-validate/'), $this->toWireList($payloads));

        return $this->toCollection($response, ZatcaValidationResultData::class);
    }

    public function updateMetadata(string $id, array $metadata): ZatcaDocumentData
    {
        $response = $this->http->patch($this->path("{$id}/"), ['metadata' => $metadata]);

        return $this->toData($response, ZatcaDocumentData::class);
    }

    public function download(string $id, ZatcaDownloadType $type = ZatcaDownloadType::Pdf, bool $regenerate = false): Response
    {
        $query = ['type' => $type->value];

        if ($regenerate) {
            $query['regenerate'] = 'true';
        }

        $response = $this->http->get($this->path("{$id}/download/"), $query);
        $this->guardResponse($response);

        return $response;
    }

    public function retry(string $id): ZatcaDocumentData
    {
        return $this->toData($this->http->post($this->path("{$id}/retry/")), ZatcaDocumentData::class);
    }

    public function send(string $id, array|ZatcaDeliveryOptionsData $payload): ZatcaDocumentData
    {
        return $this->toData($this->http->post($this->path("{$id}/send/"), $this->toWire($payload)), ZatcaDocumentData::class);
    }

    protected function path(string $suffix = ''): string
    {
        return $this->type->path().$suffix;
    }

    /**
     * Build the request body: the document plus optional top-level keys.
     *
     * Explicit `$options` override keys carried by a {@see ZatcaReportRequestData};
     * the `document` argument always wins over a `document` option.
     *
     * @param  array<string, mixed>|ZatcaDocumentPayloadData|ZatcaReportRequestData  $document
     * @param  array<string, mixed>|ZatcaDeliveryOptionsData  $options
     * @return array<string, mixed>
     */
    protected function payload(array|ZatcaDocumentPayloadData|ZatcaReportRequestData $document, array|ZatcaDeliveryOptionsData $options): array
    {
        if ($document instanceof ZatcaReportRequestData) {
            $request = $document->toPayload();
            /** @var array<string, mixed> $documentBody */
            $documentBody = $request['document'];
            $base = array_diff_key($request, ['document' => true]);
        } else {
            $documentBody = $this->toWire($document);
            $base = [];
        }

        return [...$base, ...$this->toWire($options), 'document' => $documentBody];
    }
}
