<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithPaymentsModel;
use HWafeq\LaravelWafeq\Contracts\PaymentsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Payments\PaymentCreated;
use HWafeq\LaravelWafeq\Events\Payments\PaymentDestroyed;
use HWafeq\LaravelWafeq\Events\Payments\PaymentDownloaded;
use HWafeq\LaravelWafeq\Events\Payments\PaymentListed;
use HWafeq\LaravelWafeq\Events\Payments\PaymentPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Payments\PaymentRetrieved;
use HWafeq\LaravelWafeq\Events\Payments\PaymentUpdated;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * PaymentsResource Resource.
 *
 * @see LaravelWafeq
 */
class PaymentsResource implements PaymentsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithPaymentsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PaymentData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/payments/', $query), PaymentData::class);

        event(new PaymentListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PaymentData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/payments/', $payload), PaymentData::class);

        event(new PaymentCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): PaymentData
    {
        $data = $this->toData($this->http->get("/payments/{$id}/"), PaymentData::class);

        event(new PaymentRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PaymentData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/payments/{$id}/", $payload), PaymentData::class);

        event(new PaymentUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PaymentData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/payments/{$id}/", $payload), PaymentData::class);

        event(new PaymentPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/payments/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new PaymentDestroyed(PaymentData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/payments/{$id}/download/");
        $this->guardResponse($response);

        event(new PaymentDownloaded(PaymentData::from(['id' => $id]), $id));

        return $response;
    }
}
