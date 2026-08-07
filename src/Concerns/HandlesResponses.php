<?php

namespace HWafeq\LaravelWafeq\Concerns;

use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Exceptions\AuthenticationException;
use HWafeq\LaravelWafeq\Exceptions\NotFoundException;
use HWafeq\LaravelWafeq\Exceptions\RateLimitException;
use HWafeq\LaravelWafeq\Exceptions\ServerException;
use HWafeq\LaravelWafeq\Exceptions\ValidationException;
use HWafeq\LaravelWafeq\Exceptions\WafeqException;
use HWafeq\LaravelWafeq\Support\IdempotencyMiddleware;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Spatie\LaravelData\Data;

/**
 * Shared HTTP plumbing used by every Resource class.
 *
 * Provides typed conversion from `Illuminate\Http\Client\Response`
 * to a Spatie Data DTO (`toData`, `toPaginated`) plus idempotency
 * helpers (`postIdempotent`, `putIdempotent`, `patchIdempotent`,
 * `deleteIdempotent`) and a response-guard that throws the
 * matching `WafeqException` subclass on non-2xx responses.
 */
trait HandlesResponses
{
    /**
     * Convert a Laravel HTTP client response into a typed Data class.
     *
     * @template T of Data
     *
     * @param  class-string<T>  $dataClass
     * @return T
     */
    protected function toData(Response $response, string $dataClass): Data
    {
        $this->guardResponse($response);

        return $dataClass::from($response->json());
    }

    /**
     * Convert a Laravel HTTP client response into a PaginatedData collection.
     *
     * @template T of Data
     *
     * @param  class-string<T>  $itemClass
     * @return PaginatedData<T>
     */
    protected function toPaginated(Response $response, string $itemClass): PaginatedData
    {
        $this->guardResponse($response);

        /** @var PaginatedData<T> $page */
        $page = PaginatedData::fromResponse($response, $itemClass);

        return $page;
    }

    /**
     * Apply idempotency to the PendingRequest if the method is mutating.
     *
     * @param  array<string, mixed>  $config
     */
    protected function idempotent(PendingRequest $request, array $config): PendingRequest
    {
        return IdempotencyMiddleware::apply($request, $config);
    }

    /**
     * Get the Wafeq config from the container.
     *
     * @return array<string, mixed>
     */
    protected function wafeqConfig(): array
    {
        return function_exists('config') ? (array) config('wafeq', []) : [];
    }

    /**
     * Send a POST request with idempotency applied.
     *
     * @param  array<array-key, mixed>  $payload
     */
    protected function postIdempotent(PendingRequest $request, string $url, array $payload): Response
    {
        return $this->idempotent($request, $this->wafeqConfig())->post($url, $payload);
    }

    /**
     * Send a PUT request with idempotency applied.
     *
     * @param  array<array-key, mixed>  $payload
     */
    protected function putIdempotent(PendingRequest $request, string $url, array $payload): Response
    {
        return $this->idempotent($request, $this->wafeqConfig())->put($url, $payload);
    }

    /**
     * Send a PATCH request with idempotency applied.
     *
     * @param  array<array-key, mixed>  $payload
     */
    protected function patchIdempotent(PendingRequest $request, string $url, array $payload): Response
    {
        return $this->idempotent($request, $this->wafeqConfig())->patch($url, $payload);
    }

    /**
     * Send a DELETE request with idempotency applied.
     */
    protected function deleteIdempotent(PendingRequest $request, string $url): Response
    {
        return $this->idempotent($request, $this->wafeqConfig())->delete($url);
    }

    protected function guardResponse(Response $response): void
    {
        if ($response->successful()) {
            return;
        }

        $context = [
            'body' => $response->json(),
            'headers' => $response->headers(),
        ];

        match (true) {
            $response->status() === 401, $response->status() === 403 => throw new AuthenticationException(
                $this->errorMessage($response),
                $response->status(),
                $context,
            ),
            $response->status() === 404 => throw new NotFoundException(
                $this->errorMessage($response),
                $response->status(),
                $context,
            ),
            $response->status() === 422 => throw new ValidationException(
                $this->errorMessage($response),
                $response->status(),
                $context + ['errors' => $response->json('errors') ?? []],
            ),
            $response->status() === 429 => throw new RateLimitException(
                $this->errorMessage($response),
                $response->status(),
                $context + ['retry_after' => $response->header('Retry-After')],
            ),
            $response->status() >= 500 => throw new ServerException(
                $this->errorMessage($response),
                $response->status(),
                $context,
            ),
            default => throw new WafeqException(
                $this->errorMessage($response),
                $response->status(),
                $context,
            ),
        };
    }

    protected function errorMessage(Response $response): string
    {
        $body = $response->json();

        if (is_array($body) && isset($body['detail']) && is_string($body['detail'])) {
            return $body['detail'];
        }

        if (is_array($body) && isset($body['error']) && is_string($body['error'])) {
            return $body['error'];
        }

        return "Wafeq request failed with status {$response->status()}.";
    }
}
