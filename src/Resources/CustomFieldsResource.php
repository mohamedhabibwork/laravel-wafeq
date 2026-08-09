<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithCustomFieldsModel;
use HWafeq\LaravelWafeq\Contracts\CustomFieldsResourceContract;
use HWafeq\LaravelWafeq\Data\CustomFieldData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldCreated;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldDestroyed;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldListed;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldRetrieved;
use HWafeq\LaravelWafeq\Events\CustomFields\CustomFieldUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * CustomFieldsResource Resource.
 *
 * @see LaravelWafeq
 */
class CustomFieldsResource implements CustomFieldsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithCustomFieldsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<CustomFieldData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/custom-fields/', $query), CustomFieldData::class);

        event(new CustomFieldListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): CustomFieldData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/custom-fields/', $payload), CustomFieldData::class);

        event(new CustomFieldCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): CustomFieldData
    {
        $data = $this->toData($this->http->get("/custom-fields/{$id}/"), CustomFieldData::class);

        event(new CustomFieldRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): CustomFieldData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/custom-fields/{$id}/", $payload), CustomFieldData::class);

        event(new CustomFieldUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): CustomFieldData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/custom-fields/{$id}/", $payload), CustomFieldData::class);

        event(new CustomFieldPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/custom-fields/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new CustomFieldDestroyed(CustomFieldData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
