<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeliveryOptionsData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use HWafeq\LaravelWafeq\Support\Zatca\ZatcaDocumentRules;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /zatca/{documents}/{id}/send/` — deliver an
 * existing document (`channels`, `language`, `metadata`, `reference`,
 * `template`). Requires at least one channel.
 */
class SendZatcaDocumentRequest extends WafeqFormRequest
{
    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $rules = ZatcaDocumentRules::deliveryOptions();
        $rules['channels'] = ['required', ...array_values(array_diff($rules['channels'], ['nullable']))];

        return $rules;
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ZatcaDeliveryOptionsData::class;
    }

    public function toDto(): ZatcaDeliveryOptionsData
    {
        return ZatcaDeliveryOptionsData::from($this->validated());
    }
}
