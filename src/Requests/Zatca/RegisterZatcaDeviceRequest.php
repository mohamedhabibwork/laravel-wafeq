<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeviceRegistrationData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /zatca/devices/register/` — onboard a device with
 * a Fatoora portal OTP.
 *
 * ```php
 * $dto = $request->toDto();
 * LaravelWafeq::zatca()->devices()->register($dto->commonName, $dto->otp);
 * ```
 */
class RegisterZatcaDeviceRequest extends WafeqFormRequest
{
    private const MAX_COMMON_NAME = 64;

    private const MAX_OTP = 255;

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'common_name' => ['required', 'string', 'max:'.self::MAX_COMMON_NAME],
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
