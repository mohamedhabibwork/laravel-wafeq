<?php

namespace HWafeq\LaravelWafeq\Resources\Zatca;

use HWafeq\LaravelWafeq\Concerns\Zatca\HandlesZatcaResponses;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaDevicesResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDeviceData;
use HWafeq\LaravelWafeq\Events\Zatca\ZatcaDeviceRegistered;
use Illuminate\Http\Client\PendingRequest;

/**
 * ZatcaDevicesResource Resource.
 *
 * @see LaravelWafeq
 */
class ZatcaDevicesResource implements ZatcaDevicesResourceContract
{
    use HandlesZatcaResponses;

    private const PATH = '/zatca/devices/';

    public function __construct(protected readonly PendingRequest $http) {}

    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get(self::PATH, $query), ZatcaDeviceData::class);
    }

    public function retrieve(string $id): ZatcaDeviceData
    {
        return $this->toData($this->http->get(self::PATH."{$id}/"), ZatcaDeviceData::class);
    }

    public function register(string $commonName, string $otp): ZatcaDeviceData
    {
        $payload = ['common_name' => $commonName, 'otp' => $otp];

        $data = $this->toData($this->http->post(self::PATH.'register/', $payload), ZatcaDeviceData::class);

        event(new ZatcaDeviceRegistered($data, $data->id, ['common_name' => $commonName]));

        return $data;
    }

    public function renew(string $id, string $otp): ZatcaDeviceData
    {
        return $this->toData($this->http->post(self::PATH."{$id}/renew/", ['otp' => $otp]), ZatcaDeviceData::class);
    }

    public function revoke(string $id): ZatcaDeviceData
    {
        return $this->toData($this->http->post(self::PATH."{$id}/revoke/"), ZatcaDeviceData::class);
    }
}
