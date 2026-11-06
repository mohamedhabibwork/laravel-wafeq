<?php

namespace HWafeq\LaravelWafeq\Resources\Zatca;

use HWafeq\LaravelWafeq\Concerns\Zatca\HandlesZatcaResponses;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaUsageResourceContract;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaUsageData;
use Illuminate\Http\Client\PendingRequest;

/**
 * ZatcaUsageResource Resource.
 *
 * @see LaravelWafeq
 */
class ZatcaUsageResource implements ZatcaUsageResourceContract
{
    use HandlesZatcaResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    public function retrieve(): ZatcaUsageData
    {
        return $this->toData($this->http->get('/zatca/usage/'), ZatcaUsageData::class);
    }
}
