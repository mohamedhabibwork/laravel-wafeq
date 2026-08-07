<?php

namespace HWafeq\LaravelWafeq\Tests\Pests\Concerns;

use HWafeq\LaravelWafeq\Tests\Pests\WafeqFake;
use Illuminate\Support\Facades\Http;

trait FakesWafeq
{
    /**
     * Fake a response for a relative Wafeq path.
     *
     * @param  array<string, mixed>|callable|string  $body
     */
    protected function fakeWafeq(string $path, array|callable|string $body, int $status = 200): void
    {
        WafeqFake::fakePath($path, $body, $status);
    }

    /**
     * Fake a paginated list response.
     *
     * @param  array<int, array<string, mixed>>  $results
     */
    protected function fakeWafeqPage(string $path, array $results, int $count = 0, ?string $next = null): void
    {
        $this->fakeWafeq($path, WafeqFake::page($results, $next, $count));
    }

    /**
     * Fake a 401 authentication failure.
     */
    protected function fakeAuthError(string $path = '/*'): void
    {
        Http::fake([
            WafeqFake::path().$path => Http::response(['detail' => 'Invalid API key.'], 401),
        ]);
    }

    /**
     * Fake a 404 not-found failure.
     */
    protected function fakeNotFound(string $path = '/*'): void
    {
        Http::fake([
            WafeqFake::path().$path => Http::response(['detail' => 'Resource not found.'], 404),
        ]);
    }

    /**
     * Fake a 422 validation failure.
     *
     * @param  array<string, mixed>  $errors
     */
    protected function fakeValidationError(string $path, array $errors = []): void
    {
        Http::fake([
            WafeqFake::path().$path => Http::response([
                'detail' => 'Validation failed.',
                'errors' => $errors,
            ], 422),
        ]);
    }

    /**
     * Fake a 429 rate-limit failure.
     */
    protected function fakeRateLimit(string $path = '/*'): void
    {
        Http::fake([
            WafeqFake::path().$path => Http::response(
                ['detail' => 'Too many requests.'],
                429,
                ['Retry-After' => '60'],
            ),
        ]);
    }

    /**
     * Fake a 500 server failure.
     */
    protected function fakeServerError(string $path = '/*'): void
    {
        Http::fake([
            WafeqFake::path().$path => Http::response(['detail' => 'Server error.'], 500),
        ]);
    }
}
