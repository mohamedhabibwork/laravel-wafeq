<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithPaymentRequestsModel;
use HWafeq\LaravelWafeq\Contracts\PaymentRequestsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestCreated;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestDestroyed;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestListed;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestRetrieved;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * PaymentRequestsResource Resource.
 *
 * @see LaravelWafeq
 */
class PaymentRequestsResource implements PaymentRequestsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithPaymentRequestsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PaymentRequestData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/payment-requests/', $query), PaymentRequestData::class);

        event(new PaymentRequestListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PaymentRequestData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/payment-requests/', $payload), PaymentRequestData::class);

        event(new PaymentRequestCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): PaymentRequestData
    {
        $data = $this->toData($this->http->get("/payment-requests/{$id}/"), PaymentRequestData::class);

        event(new PaymentRequestRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PaymentRequestData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/payment-requests/{$id}/", $payload), PaymentRequestData::class);

        event(new PaymentRequestUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PaymentRequestData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/payment-requests/{$id}/", $payload), PaymentRequestData::class);

        event(new PaymentRequestPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/payment-requests/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new PaymentRequestDestroyed(PaymentRequestData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
