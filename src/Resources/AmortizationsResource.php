<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithAmortizationsModel;
use HWafeq\LaravelWafeq\Contracts\AmortizationsResourceContract;
use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Amortizations\AmortizationCreated;
use HWafeq\LaravelWafeq\Events\Amortizations\AmortizationDestroyed;
use HWafeq\LaravelWafeq\Events\Amortizations\AmortizationListed;
use HWafeq\LaravelWafeq\Events\Amortizations\AmortizationPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Amortizations\AmortizationRetrieved;
use HWafeq\LaravelWafeq\Events\Amortizations\AmortizationUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * AmortizationsResource Resource.
 *
 * @see LaravelWafeq
 */
class AmortizationsResource implements AmortizationsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithAmortizationsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<AmortizationData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/amortizations/', $query), AmortizationData::class);

        event(new AmortizationListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): AmortizationData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/amortizations/', $payload), AmortizationData::class);

        event(new AmortizationCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): AmortizationData
    {
        $data = $this->toData($this->http->get("/amortizations/{$id}/"), AmortizationData::class);

        event(new AmortizationRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): AmortizationData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/amortizations/{$id}/", $payload), AmortizationData::class);

        event(new AmortizationUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): AmortizationData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/amortizations/{$id}/", $payload), AmortizationData::class);

        event(new AmortizationPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/amortizations/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new AmortizationDestroyed(AmortizationData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewCreate(array $payload): AmortizationData
    {
        return $this->toData($this->postIdempotent($this->http, '/amortizations/preview/', $payload), AmortizationData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function endEarly(string $id, array $payload = []): AmortizationData
    {
        return $this->toData($this->postIdempotent($this->http, "/amortizations/{$id}/end_early/", $payload), AmortizationData::class);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function previewEndEarly(string $id, array $payload = []): AmortizationData
    {
        return $this->toData($this->postIdempotent($this->http, "/amortizations/{$id}/preview_end_early/", $payload), AmortizationData::class);
    }
}
