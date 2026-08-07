<?php

namespace HWafeq\LaravelWafeq;

use HWafeq\LaravelWafeq\Enums\Environment;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * Connector Class.
 *
 * @see LaravelWafeq
 */
class Connector
{
    /**
     * @param  array<string, mixed>  $config
     */
    public function __construct(private readonly array $config) {}

    public function environment(): Environment
    {
        return Environment::from((string) ($this->config['environment'] ?? 'sandbox'));
    }

    public function baseUrl(): string
    {
        $env = $this->environment();
        $override = $this->config['base_urls'][$env->value] ?? null;

        return is_string($override) && $override !== '' ? $override : $env->baseUrl();
    }

    public function apiKey(): string
    {
        return (string) ($this->config['api_key'] ?? '');
    }

    /**
     * @return array<string, mixed>
     */
    public function config(): array
    {
        return $this->config;
    }

    public function make(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl())
            ->timeout((int) ($this->config['http']['timeout'] ?? 30))
            ->connectTimeout((int) ($this->config['http']['connect_timeout'] ?? 10))
            ->retry(
                (int) ($this->config['http']['retry']['times'] ?? 3),
                (int) ($this->config['http']['retry']['delay'] ?? 250),
                null,
                false
            )
            ->withHeaders([
                'Authorization' => 'Api-Key '.$this->apiKey(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->acceptJson();
    }
}
