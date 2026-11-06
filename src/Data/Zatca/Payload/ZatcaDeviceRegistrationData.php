<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * Register (common name + OTP) or renew (OTP only) a ZATCA device.
 * The OTP comes from the Fatoora portal and is valid for one hour.
 */
class ZatcaDeviceRegistrationData extends ZatcaPayloadData
{
    public function __construct(
        public string $otp,
        public ?string $commonName = null,
    ) {}
}
