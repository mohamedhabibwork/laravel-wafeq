<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithUnitsOfMeasureModel;
use HWafeq\LaravelWafeq\Contracts\UnitsOfMeasureResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\UnitOfMeasureData;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureCreated;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureDestroyed;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureListed;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasurePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureRetrieved;
use HWafeq\LaravelWafeq\Events\UnitsOfMeasure\UnitOfMeasureUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * UnitsOfMeasureResource Resource.
 *
 * @see LaravelWafeq
 */
class UnitsOfMeasureResource implements UnitsOfMeasureResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithUnitsOfMeasureModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<UnitOfMeasureData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/units-of-measure/', $query), UnitOfMeasureData::class);

        event(new UnitOfMeasureListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): UnitOfMeasureData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/units-of-measure/', $payload), UnitOfMeasureData::class);

        event(new UnitOfMeasureCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): UnitOfMeasureData
    {
        $data = $this->toData($this->http->get("/units-of-measure/{$id}/"), UnitOfMeasureData::class);

        event(new UnitOfMeasureRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): UnitOfMeasureData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/units-of-measure/{$id}/", $payload), UnitOfMeasureData::class);

        event(new UnitOfMeasureUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): UnitOfMeasureData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/units-of-measure/{$id}/", $payload), UnitOfMeasureData::class);

        event(new UnitOfMeasurePartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/units-of-measure/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new UnitOfMeasureDestroyed(UnitOfMeasureData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
