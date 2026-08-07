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

];
