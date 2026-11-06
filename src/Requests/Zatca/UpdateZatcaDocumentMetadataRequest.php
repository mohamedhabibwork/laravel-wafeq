<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaMetadataUpdateData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `PATCH /zatca/{documents}/{id}/` — merge metadata into a
 * document. A `null` value removes that key.
 */
class UpdateZatcaDocumentMetadataRequest extends WafeqFormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'metadata' => ['present', 'array'],
            'metadata.*' => ['nullable', 'string'],
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ZatcaMetadataUpdateData::class;
    }

    public function toDto(): ZatcaMetadataUpdateData
    {
        return ZatcaMetadataUpdateData::from($this->validated());
    }
}
