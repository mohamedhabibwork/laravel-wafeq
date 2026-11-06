<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaConnectedAccountPayloadData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use HWafeq\LaravelWafeq\Support\Zatca\ZatcaCodeLists;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /zatca/connected-accounts/` — onboard a platform
 * customer. {@see UpdateZatcaConnectedAccountRequest} reuses these rules
 * for `PUT`.
 */
class CreateZatcaConnectedAccountRequest extends WafeqFormRequest
{
    private const MAX_NAME = 255;

    private const MAX_ADDRESS = 255;

    private const MAX_CITY = 200;

    private const MAX_BUSINESS_CATEGORY = 200;

    private const VAT_NUMBER_LENGTH = 15;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => [$this->presence(), 'string', 'max:'.self::MAX_NAME],
            'address' => [$this->presence(), 'string', 'max:'.self::MAX_ADDRESS],
            'city' => [$this->presence(), 'string', 'max:'.self::MAX_CITY],
            'business_category' => [$this->presence(), 'string', 'max:'.self::MAX_BUSINESS_CATEGORY],
            'tax_registration_number' => [$this->presence(), 'string', 'size:'.self::VAT_NUMBER_LENGTH],
            'country' => ['sometimes', Rule::in(ZatcaCodeLists::COUNTRY_CODES)],
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ZatcaConnectedAccountPayloadData::class;
    }

    public function toDto(): ZatcaConnectedAccountPayloadData
    {
        return ZatcaConnectedAccountPayloadData::from($this->validated());
    }

    /**
     * Presence rule for the fields `POST` / `PUT` require.
     */
    protected function presence(): string
    {
        return 'required';
    }
}
