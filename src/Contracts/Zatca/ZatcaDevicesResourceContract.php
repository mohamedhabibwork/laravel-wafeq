<?php

namespace HWafeq\LaravelWafeq\Contracts\Zatca;

use HWafeq\LaravelWafeq\Contracts\ResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDeviceData;

/**
 * Devices (solution units) onboarded to ZATCA with a Fatoora portal OTP.
 *
 * A device belongs to the environment, branch and connected account the
 * resource was scoped to when it was registered.
 */
interface ZatcaDevicesResourceContract extends ResourceContract
{
    /**
     * @param  array{keyword?: string, page?: int, page_size?: int}  $query
     * @return PaginatedData<ZatcaDeviceData>
     */
    public function list(array $query = []): PaginatedData;

    public function retrieve(string $id): ZatcaDeviceData;

    /**
     * Register a device using an OTP from the Fatoora portal (valid for 1 hour).
     */
    public function register(string $commonName, string $otp): ZatcaDeviceData;

    /**
     * Renew a device's certificate with a fresh Fatoora portal OTP.
     */
    public function renew(string $id, string $otp): ZatcaDeviceData;

    public function revoke(string $id): ZatcaDeviceData;
}
