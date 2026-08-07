<?php

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Data\QuoteData;
use Illuminate\Http\Client\Response;

/**
 * QuotesResourceContract Contract.
 *
 * @see LaravelWafeq
 */
interface QuotesResourceContract extends ResourceContract
{
    /**
     * @param  array<string, mixed>  $query
     * @return PaginatedData<QuoteData>
     */
    public function list(array $query = []): PaginatedData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function create(array $payload): QuoteData;

    public function retrieve(string $id): QuoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function update(string $id, array $payload): QuoteData;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function partialUpdate(string $id, array $payload): QuoteData;

    public function destroy(string $id): bool;

    public function download(string $id): Response;

    /**
     * @param  array<string, mixed>  $payload
     */
    public function invoice(string $id, array $payload = []): InvoiceData;
}
