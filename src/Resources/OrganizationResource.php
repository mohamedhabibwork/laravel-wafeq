<?php

namespace HWafeq\LaravelWafeq\Resources;

use HWafeq\LaravelWafeq\Concerns\HandlesResponses;
use HWafeq\LaravelWafeq\Contracts\OrganizationResourceContract;
use HWafeq\LaravelWafeq\Data\OrganizationData;
use HWafeq\LaravelWafeq\Exceptions\WafeqException;
use Illuminate\Http\Client\PendingRequest;

/**
 * Concrete /organization/ resource.
 */
/**
 * OrganizationResource Resource.
 *
 * @see LaravelWafeq
 */
class OrganizationResource implements OrganizationResourceContract
{
    use HandlesResponses;

    public function __construct(protected readonly PendingRequest $http) {}

    /**
     * Fetch the current organization.
     *
     * @throws WafeqException on non-2xx responses
     */
    public function retrieve(): OrganizationData
    {
        $response = $this->http->get('/organization/');
        $this->guardResponse($response);

        return OrganizationData::from($response->json());
    }
}
