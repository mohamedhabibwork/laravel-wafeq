<?php

namespace HWafeq\LaravelWafeq\Contracts\Zatca;

use HWafeq\LaravelWafeq\Contracts\ResourceContract;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaConnectedAccountPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaConnectedAccountData;

/**
 * Connected accounts for platform / white-label integrations that onboard
 * customers and report documents on their behalf.
 *
 * @see https://docs.wafeq.com/zatca/for-platforms-or-white-label
 */
interface ZatcaConnectedAccountsResourceContract extends ResourceContract
{
    /**
     * @param  array{page?: int, page_size?: int}  $query
     * @return PaginatedData<ZatcaConnectedAccountData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array{name: string, address: string, city: string, business_category: string, tax_registration_number: string, country?: string}|ZatcaConnectedAccountPayloadData  $payload
     */
    public function create(array|ZatcaConnectedAccountPayloadData $payload): ZatcaConnectedAccountData;

    public function retrieve(string $id): ZatcaConnectedAccountData;

    /**
     * @param  array{name: string, address: string, city: string, business_category: string, tax_registration_number: string, country?: string}|ZatcaConnectedAccountPayloadData  $payload
     */
    public function update(string $id, array|ZatcaConnectedAccountPayloadData $payload): ZatcaConnectedAccountData;

    /**
     * @param  array<string, mixed>|ZatcaConnectedAccountPayloadData  $payload
     */
    public function partialUpdate(string $id, array|ZatcaConnectedAccountPayloadData $payload): ZatcaConnectedAccountData;

    public function destroy(string $id): bool;
}
