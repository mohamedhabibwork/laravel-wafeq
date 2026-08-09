<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\InteractsWithPayslipsModel;
use HWafeq\LaravelWafeq\Contracts\PayslipsResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipCreated;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipDestroyed;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipDownloaded;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipListed;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipRetrieved;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipUpdated;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

/**
 * PayslipsResource Resource.
 *
 * @see LaravelWafeq
 */
class PayslipsResource implements PayslipsResourceContract
{
    use HandlesResponses;
    use HoldsWafeqModel;
    use InteractsWithPayslipsModel;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<PayslipData>
     */
    public function list(array $query = []): PaginatedData
    {
        $page = $this->toPaginated($this->http->get('/payslips/', $query), PayslipData::class);

        event(new PayslipListed($page, '', $query));

        return $page;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): PayslipData
    {
        $data = $this->toData($this->postIdempotent($this->http, '/payslips/', $payload), PayslipData::class);

        event(new PayslipCreated($data, $data->id, $payload));

        return $data;
    }

    public function retrieve(string $id): PayslipData
    {
        $data = $this->toData($this->http->get("/payslips/{$id}/"), PayslipData::class);

        event(new PayslipRetrieved($data, $id));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): PayslipData
    {
        $data = $this->toData($this->putIdempotent($this->http, "/payslips/{$id}/", $payload), PayslipData::class);

        event(new PayslipUpdated($data, $id, $payload));

        return $data;
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): PayslipData
    {
        $data = $this->toData($this->patchIdempotent($this->http, "/payslips/{$id}/", $payload), PayslipData::class);

        event(new PayslipPartiallyUpdated($data, $id, $payload));

        return $data;
    }

    public function destroy(string $id): bool
    {
        $response = $this->deleteIdempotent($this->http, "/payslips/{$id}/");
        $this->guardResponse($response);

        $ok = $response->successful();

        if ($ok) {
            event(new PayslipDestroyed(PayslipData::from(['id' => $id]), $id));
        }

        return $ok;
    }

    public function download(string $id): Response
    {
        $response = $this->http->get("/payslips/{$id}/download/");
        $this->guardResponse($response);

        event(new PayslipDownloaded(PayslipData::from(['id' => $id]), $id));

        return $response;
    }
}
