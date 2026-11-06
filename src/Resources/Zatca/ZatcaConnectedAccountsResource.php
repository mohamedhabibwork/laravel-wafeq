<?php

namespace HWafeq\LaravelWafeq\Resources\Zatca;

use HWafeq\LaravelWafeq\Concerns\Zatca\HandlesZatcaResponses;
use HWafeq\LaravelWafeq\Concerns\Zatca\NormalizesZatcaPayloads;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaConnectedAccountsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaConnectedAccountPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaConnectedAccountData;
use HWafeq\LaravelWafeq\Events\Zatca\ZatcaConnectedAccountCreated;
use Illuminate\Http\Client\PendingRequest;

/**
 * ZatcaConnectedAccountsResource Resource.
 *
 * @see LaravelWafeq
 */
class ZatcaConnectedAccountsResource implements ZatcaConnectedAccountsResourceContract
{
    use HandlesZatcaResponses;
    use NormalizesZatcaPayloads;

    private const PATH = '/zatca/connected-accounts/';

    public function __construct(protected readonly PendingRequest $http) {}

    public function list(array $query = []): PaginatedData
    {
        return $this->toPaginated($this->http->get(self::PATH, $query), ZatcaConnectedAccountData::class);
    }

    public function create(array|ZatcaConnectedAccountPayloadData $payload): ZatcaConnectedAccountData
    {
        $payload = $this->toWire($payload);

        $data = $this->toData($this->http->post(self::PATH, $payload), ZatcaConnectedAccountData::class);

        event(new ZatcaConnectedAccountCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): ZatcaConnectedAccountData
    {
        return $this->toData($this->http->get(self::PATH."{$id}/"), ZatcaConnectedAccountData::class);
    }

    public function update(string $id, array|ZatcaConnectedAccountPayloadData $payload): ZatcaConnectedAccountData
    {
        return $this->toData($this->http->put(self::PATH."{$id}/", $this->toWire($payload)), ZatcaConnectedAccountData::class);
    }

    public function partialUpdate(string $id, array|ZatcaConnectedAccountPayloadData $payload): ZatcaConnectedAccountData
    {
        return $this->toData($this->http->patch(self::PATH."{$id}/", $this->toWire($payload)), ZatcaConnectedAccountData::class);
    }

    public function destroy(string $id): bool
    {
        $response = $this->http->delete(self::PATH."{$id}/");
        $this->guardResponse($response);

        return $response->successful();
    }
}
