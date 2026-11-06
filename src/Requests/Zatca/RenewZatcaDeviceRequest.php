<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeviceRegistrationData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /zatca/devices/{id}/renew/` — renew a device with
 * a fresh Fatoora portal OTP.
 */
class RenewZatcaDeviceRequest extends WafeqFormRequest
{
    private const MAX_OTP = 255;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'otp' => ['required', 'string', 'max:'.self::MAX_OTP],
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ZatcaDeviceRegistrationData::class;
    }

    public function toDto(): ZatcaDeviceRegistrationData
    {
        return ZatcaDeviceRegistrationData::from($this->validated());
    }
}
