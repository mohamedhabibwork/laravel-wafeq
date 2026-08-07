<?php

namespace HWafeq\LaravelWafeq;

use HWafeq\LaravelWafeq\Contracts\ClientContract;

/**
 * Backwards-compatible alias for the Client singleton.
 *
 * The Facade resolves to {@see ClientContract}; this class exists so
 * existing `app('laravel-wafeq')` and `LaravelWafeq::class` references
 * keep working when the underlying implementation is swapped.
 */
/**
 * LaravelWafeq Class.
 *
 * @see LaravelWafeq
 */
class LaravelWafeq
{
    public function __construct(private readonly ClientContract $client) {}

    /**
     * Forward any call to the underlying Client.
     *
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        return $this->client->{$method}(...$arguments);
    }

    /**
     * Return the bound client instance.
     */
    public function client(): ClientContract
    {
        return $this->client;
    }
}
