# Laravel Wafeq

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohamedhabibwork/laravel-wafeq.svg?style=flat-square)](https://packagist.org/packages/mohamedhabibwork/laravel-wafeq)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mohamedhabibwork/laravel-wafeq/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mohamedhabibwork/laravel-wafeq/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mohamedhabibwork/laravel-wafeq/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mohamedhabibwork/laravel-wafeq/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mohamedhabibwork/laravel-wafeq.svg?style=flat-square)](https://packagist.org/packages/mohamedhabibwork/laravel-wafeq)

A typed Laravel client for the [Wafeq](https://wafeq.com) accounting API. Every endpoint is exposed as a resource behind a single `LaravelWafeq` facade, returning [`spatie/laravel-data`](https://github.com/spatie/laravel-data) DTOs so you get autocompletion, immutability and validation on every response.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-wafeq.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-wafeq)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require mohamedhabibwork/laravel-wafeq
```

Optionally, publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-wafeq-config"
```

This is the contents of the published config file:

```php
return [
    // Sandbox for local development, production for live traffic.
    'environment' => env('WAFEQ_ENVIRONMENT', 'sandbox'),

    // Required. Generate one at https://app.wafeq.com/c/api-keys
    'api_key' => env('WAFEQ_API_KEY'),

    'base_urls' => [
        'sandbox' => env('WAFEQ_SANDBOX_BASE_URL', 'https://api-sandbox.wafeq.com/v1'),
        'production' => env('WAFEQ_PRODUCTION_BASE_URL', 'https://api.wafeq.com/v1'),
    ],

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
```

At minimum, set `WAFEQ_API_KEY` (and `WAFEQ_ENVIRONMENT=production` when you're ready for live traffic).

## Usage

Resolve resources through the `LaravelWafeq` facade. Each resource exposes `list`, `create`, `retrieve`, `update`, `partialUpdate`, and `destroy`, and returns typed DTOs from [`spatie/laravel-data`](https://github.com/spatie/laravel-data).

```php
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;

// List contacts with optional filters, returned as PaginatedData<ContactData>
$contacts = LaravelWafeq::contacts()->list(['limit' => 50]);

foreach ($contacts->data as $contact) {
    echo $contact->name;
}

// Retrieve a single contact
$contact = LaravelWafeq::contacts()->retrieve('ct_123');

// Create a contact
$contact = LaravelWafeq::contacts()->create([
    'name' => 'Acme Inc.',
    'type' => 'business',
    'email' => '[email protected]',
]);

// Update (PUT) or partial update (PATCH)
$contact = LaravelWafeq::contacts()->update('ct_123', [
    'name' => 'Acme Incorporated',
    'type' => 'business',
    'email' => '[email protected]',
]);

$contact = LaravelWafeq::contacts()->partialUpdate('ct_123', [
    'email' => '[email protected]',
]);

// Delete
LaravelWafeq::contacts()->destroy('ct_123');
```

Other resources follow the same shape — for example `invoices()`, `accounts()`, `payments()`, `bills()`, `quotes()`, `purchaseOrders()`, `expenses()`, `payslips()`, `manualJournals()`, `taxRates()`, `warehouses()`, `reports()`, and `organization()`. All 45 resources and their contracts live under `HWafeq\LaravelWafeq\Contracts`.

### Idempotency

Mutating calls accept an idempotency key so retries are safe. The header name is configurable via the `idempotency_header` config key (default `X-Wafeq-Idempotency-Key`). Mutating requests are also retried automatically on `429` and `503` responses per the `http.retry` config.

## Testing

```bash
composer test
```

The test suite uses [Pest](https://pestphp.com) and ships an `FakesWafeq` trait that swaps `Http::fake()` for any resource test, so you can stub Wafeq responses without touching the network.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mohamed Habib](https://github.com/mohamedhabibwork)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.