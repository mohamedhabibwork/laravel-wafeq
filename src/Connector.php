<?php

namespace HWafeq\LaravelWafeq;

use HWafeq\LaravelWafeq\Enums\Environment;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
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

    /**
     * Build a PendingRequest for the Wafeq ZATCA API.
     *
     * Unlike {@see self::make()}, only connection failures and the
     * configured `http.retry.when` statuses (429 / 503 by default) are
     * retried, so a failed report is never silently re-submitted.
     *
     * @param  array<string, string>  $headers  ZATCA scoping headers (`X-ZATCA-*`).
     */
    public function makeZatca(array $headers = []): PendingRequest
    {
        /** @var array<int, int> $retryWhen */
        $retryWhen = (array) ($this->config['http']['retry']['when'] ?? [429, 503]);

        return Http::baseUrl($this->zatcaBaseUrl())
            ->timeout((int) ($this->config['http']['timeout'] ?? 30))
            ->connectTimeout((int) ($this->config['http']['connect_timeout'] ?? 10))
            ->retry(
                (int) ($this->config['http']['retry']['times'] ?? 3),
                (int) ($this->config['http']['retry']['delay'] ?? 250),
                static fn (\Throwable $exception): bool => $exception instanceof ConnectionException
                    || ($exception instanceof RequestException && in_array($exception->response->status(), $retryWhen, true)),
                false
            )
            ->withHeaders([
                'Authorization' => 'Api-Key '.$this->zatcaApiKey(),
                'Accept' => 'application/json; version=v1',
                'Content-Type' => 'application/json',
                ...$headers,
            ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function zatcaConfig(): array
    {
        return (array) ($this->config['zatca'] ?? []);
    }

    public function zatcaBaseUrl(): string
    {
        $url = $this->zatcaConfig()['base_url'] ?? null;

        return is_string($url) && $url !== '' ? $url : Environment::Production->baseUrl();
    }

    /**
     * The dedicated ZATCA API key when configured, otherwise the main key.
     */
    public function zatcaApiKey(): string
    {
        $key = $this->zatcaConfig()['api_key'] ?? null;

        return is_string($key) && $key !== '' ? $key : $this->apiKey();
    }
}
