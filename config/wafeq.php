<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | Determines which Wafeq environment the package targets. Use "sandbox"
    | for local development and "production" for live traffic.
    |
    */

    'environment' => env('WAFEQ_ENVIRONMENT', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Your Wafeq API key. Required when authenticating with Api-Key header.
    | Generate one at https://app.wafeq.com/c/api-keys
    |
    */

    'api_key' => env('WAFEQ_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Base URLs
    |--------------------------------------------------------------------------
    |
    | Override these only if Wafeq publishes new endpoints or you operate
    | against a private gateway.
    |
    */

    'base_urls' => [
        'sandbox' => env('WAFEQ_SANDBOX_BASE_URL', 'https://api-sandbox.wafeq.com/v1'),
        'production' => env('WAFEQ_PRODUCTION_BASE_URL', 'https://api.wafeq.com/v1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | HTTP options
    |--------------------------------------------------------------------------
    |
    | Timeouts, retry policy and idempotency header name.
    |
    */

    'http' => [
        'timeout' => (int) env('WAFEQ_HTTP_TIMEOUT', 30),
        'connect_timeout' => (int) env('WAFEQ_HTTP_CONNECT_TIMEOUT', 10),
        'retry' => [
            'times' => (int) env('WAFEQ_RETRY_TIMES', 3),
            'delay' => (int) env('WAFEQ_RETRY_DELAY', 250),
            'when' => [429, 503],
        ],
        'log' => env('WAFEQ_HTTP_LOG', false),
    ],

    'idempotency_header' => env('WAFEQ_IDEMPOTENCY_HEADER', 'X-Wafeq-Idempotency-Key'),

    /*
    |--------------------------------------------------------------------------
    | Default currency
    |--------------------------------------------------------------------------
    |
    | ISO-4217 currency code the package should fall back to whenever a DTO
    | property typed `?Currency` (or tagged with #[WithCurrency]) hydrates
    | from a null wire value. Set this to your organisation's base currency
    | and the package will silently fill it in for you.
    |
    | When `null`, the package will fetch the base currency from the
    | authenticated organisation's financial_settings on the first call
    | that needs it and cache it for the rest of the request lifecycle.
    |
    */

    'currency' => env('WAFEQ_CURRENCY'),

    /*
    |--------------------------------------------------------------------------
    | ZATCA e-invoicing
    |--------------------------------------------------------------------------
    |
    | Settings for the Wafeq ZATCA API (`LaravelWafeq::zatca()`).
    |
    | - environment: "simulation" (Fatoora simulation portal, nothing is
    |   submitted to the tax authority) or "production". Sent as the
    |   `X-ZATCA-Environment` header.
    | - api_key: optional dedicated ZATCA key (`zatca_live_…` / `zatca_sim_…`).
    |   Falls back to `api_key` above. A dedicated key must match the
    |   configured environment.
    | - base_url: the ZATCA API is only served from the production host;
    |   the environment header, not the URL, selects simulation.
    | - branch: default `X-ZATCA-Branch` (a Group VAT member's TIN, or a
    |   branch name).
    | - connected_account: default `X-ZATCA-Connected-Account-Id` for
    |   platform / white-label integrations. Usually set per call with
    |   `zatca()->forConnectedAccount($id)` instead.
    |
    */

    'zatca' => [
        'environment' => env('WAFEQ_ZATCA_ENVIRONMENT', 'simulation'),
        'api_key' => env('WAFEQ_ZATCA_API_KEY'),
        'base_url' => env('WAFEQ_ZATCA_BASE_URL', 'https://api.wafeq.com/v1'),
        'branch' => env('WAFEQ_ZATCA_BRANCH'),
        'connected_account' => env('WAFEQ_ZATCA_CONNECTED_ACCOUNT'),
    ],

];
