<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithPayslipsPayItemsModel;
use HWafeq\LaravelWafeq\Contracts\PayslipsPayItemsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemCreated;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemDestroyed;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemListed;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemRetrieved;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemUpdated;
use Illuminate\Http\Client\PendingRequest;

/**
 * PayslipsPayItemsResource Resource.
 *
 * @see LaravelWafeq
 */
class PayslipsPayItemsResource implements PayslipsPayItemsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithPayslipsPayItemsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PayslipPayItemData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/payslips/pay-items/', $query), PayslipPayItemData::class);

        event(new PayslipPayItemListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PayslipPayItemData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/payslips/pay-items/', $payload), PayslipPayItemData::class);

        event(new PayslipPayItemCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): PayslipPayItemData
    {
        $data = $this->toData($this->http->get("/payslips/pay-items/{$id}/"), PayslipPayItemData::class);

        event(new PayslipPayItemRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PayslipPayItemData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/payslips/pay-items/{$id}/", $payload), PayslipPayItemData::class);

        event(new PayslipPayItemUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PayslipPayItemData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/payslips/pay-items/{$id}/", $payload), PayslipPayItemData::class);

        event(new PayslipPayItemPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/payslips/pay-items/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new PayslipPayItemDestroyed(PayslipPayItemData::from(['id' => $id]), $id));
        }

        return $ok;
    }
}
