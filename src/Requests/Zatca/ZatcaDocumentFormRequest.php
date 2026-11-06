<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaReportRequestData;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use HWafeq\LaravelWafeq\Support\Zatca\ZatcaDocumentRules;
use Spatie\LaravelData\Data;

/**
 * Base FormRequest for a ZATCA document body (`report`, `validate` and,
 * for simplified documents, `issue` share one schema).
 *
 * ```php
 * public function store(ReportZatcaSimplifiedInvoiceRequest $request)
 * {
 *     return LaravelWafeq::zatca()->simplifiedInvoices()->report($request->toDto());
 * }
 * ```
 */
abstract class ZatcaDocumentFormRequest extends WafeqFormRequest
{
    /**
     * The document family whose schema this request validates.
     */
    abstract public function documentType(): ZatcaDocumentType;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return ZatcaDocumentRules::reportRequest($this->documentType());
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ZatcaReportRequestData::class;
    }

    public function toDto(): ZatcaReportRequestData
    {
        return ZatcaReportRequestData::from($this->validated());
    }
}
