# Laravel Wafeq

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohamedhabibwork/laravel-wafeq.svg?style=flat-square)](https://packagist.org/packages/mohamedhabibwork/laravel-wafeq)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mohamedhabibwork/laravel-wafeq/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mohamedhabibwork/laravel-wafeq/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mohamedhabibwork/laravel-wafeq/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mohamedhabibwork/laravel-wafeq/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mohamedhabibwork/laravel-wafeq.svg?style=flat-square)](https://packagist.org/packages/mohamedhabibwork/laravel-wafeq)

A typed Laravel client for the [Wafeq](https://wafeq.com) accounting API. Every endpoint is exposed as a resource behind a single `LaravelWafeq` facade, returning [`spatie/laravel-data`](https://github.com/spatie/laravel-data) DTOs so you get autocompletion, immutability and validation on every response.

> **44 resources. 19 typed enums. 11 shared DTOs. 396 tests. Zero magic.**
> [Installation](#installation) · [Usage](#usage) · [Features](#features) · [Resources](#resources) · [Documentation](./docs/index.md)

---

## Why this package

- **One facade, every Wafeq endpoint** — `LaravelWafeq::contacts()`, `LaravelWafeq::invoices()`, `LaravelWafeq::bankAccounts()`, … each method returns a typed resource that maps to a specific Wafeq endpoint family.
- **Typed DTOs everywhere** — built on [`spatie/laravel-data`](https://github.com/spatie/laravel-data) with full PHPDoc, `readonly` properties and an `extra` catch-all so the package survives Wafeq schema additions without breaking your code.
- **Idempotent by default** — every mutating call (`POST` / `PUT` / `PATCH` / `DELETE`) automatically attaches a UUID idempotency header, so retries are safe.
- **Built on Laravel's HTTP client** — retries (`429`, `503`), timeouts, logging, and any custom middleware slot into the standard `Http::` pipeline.
- **Spatie Data name mapping** — DTO properties are camelCase but Wafeq's wire format is snake_case; the package transparently maps between them via Spatie Data's `SnakeCaseMapper`.
- **Localized fields handled** — `{en, ar}` Wafeq payloads hydrate into a dedicated `DualLangData` value object that implements Spatie Data's `Castable` so bare strings, arrays, or existing instances all work.
- **Typed enum casts** — every enum (`Currency`, `BillStatus`, …) implements `Spatie\LaravelData\Casts\Castable` via `SafeEnumCastable`, so unknown wire values fall back to `null` instead of throwing.
- **Eloquent bridge** — pass any `Model` into the `*Model()` overloads (or mix `HasWafeqResource` in and call `$customer->wafeq()->retrieve()`) and the package resolves the Wafeq id and builds the payload for you.
- **First-class test helpers** — `FakesWafeq` trait + `WafeqFake` helper stub every endpoint without touching the network.
- **Typed events** — every successful resource call dispatches a `WafeqEvent` subclass you can listen to for syncing, notifications, audit logs, etc.

## Requirements

- PHP **^8.3**
- Laravel **^11.0 || ^12.0 || ^13.0**
- A Wafeq API key from <https://app.wafeq.com/c/api-keys>

---

## Installation

Install the package via composer:

```bash
composer require mohamedhabibwork/laravel-wafeq
```

The service provider and `LaravelWafeq` facade are auto-discovered — no manual registration needed.

Optionally, publish the config file:

```bash
php artisan vendor:publish --tag="laravel-wafeq-config"
```

Add the API key to your `.env` (the only required setting):

```dotenv
WAFEQ_ENVIRONMENT=sandbox              # or "production" for live traffic
WAFEQ_API_KEY=your-key-here            # https://app.wafeq.com/c/api-keys
```

That's it — `LaravelWafeq::contacts()->list()` will now work.

---

## Usage

### A 30-second tour

```php
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Enums\Currency;

// List contacts — returns PaginatedData<ContactData>
$page = LaravelWafeq::contacts()->list(['limit' => 50]);

foreach ($page->results as $contact) {
    echo $contact->name;   // typed property access
}

// Retrieve one — returns ContactData
$contact = LaravelWafeq::contacts()->retrieve('ct_123');

// Create one — returns ContactData, sends an idempotency key automatically
$contact = LaravelWafeq::contacts()->create([
    'name'     => 'Acme Inc.',
    'type'     => 'business',
    'email'    => '[email protected]',
    'currency' => Currency::SAR->value,   // 'SAR'
]);

// Update (PUT) / partial update (PATCH)
$contact = LaravelWafeq::contacts()->update('ct_123', [/* full body */]);
$contact = LaravelWafeq::contacts()->partialUpdate('ct_123', ['phone' => '+966500000000']);

// Delete — returns bool
LaravelWafeq::contacts()->destroy('ct_123');
```

### Resource with extras

Some resources expose extra endpoints beyond plain CRUD:

```php
// Invoices: download the PDF (returns Illuminate\Http\Client\Response)
$pdf = LaravelWafeq::invoices()->download('inv_123');

return response()->streamDownload(
    fn () => print($pdf->body()),
    'invoice.pdf',
);

// Invoices: file a tax-authority report (ZATCA / FTA)
$report = LaravelWafeq::invoices()->taxAuthorityReport('inv_123', [
    'reporting_period' => '2026-Q3',
]);

// Quotes: convert to an invoice
$invoice = LaravelWafeq::quotes()->invoice('qt_123');

// Purchase orders: convert to a bill
$bill = LaravelWafeq::purchaseOrders()->bill('po_123');

// Expenses: flip the DRAFT ↔ POSTED lifecycle
LaravelWafeq::expenses()->markAsDraft('exp_1');   // POSTED → DRAFT
LaravelWafeq::expenses()->markAsPosted('exp_1');  // DRAFT → POSTED
```

### Nested resources

A few resources are scoped to a parent (e.g. a bank account's ledger transactions, a payslip's pay items). Their methods take the parent id as the first argument:

```php
// Every call takes the parent bank account id first
$txns = LaravelWafeq::bankLedgerTransactions()->list('ba_123');
$txn  = LaravelWafeq::bankLedgerTransactions()->create('ba_123', [...]);
$txn  = LaravelWafeq::bankLedgerTransactions()->retrieve('ba_123', 'lt_456');
$txn  = LaravelWafeq::bankLedgerTransactions()->update('ba_123', 'lt_456', [...]);

// Same pattern for:
LaravelWafeq::bankStatementTransactions()->list('ba_123');
LaravelWafeq::payslipsPayItems()->list('pay_123');
```

### Eloquent bridge

Pass an Eloquent model directly — the package reads the Wafeq id off it and builds the right payload:

```php
$contact = LaravelWafeq::contacts()->createFromModel($customer);
$contact = LaravelWafeq::contacts()->retrieveModel($customer);
$contact = LaravelWafeq::contacts()->updateModel($customer, $payload);
$contact = LaravelWafeq::contacts()->partialUpdateModel($customer, $payload);
LaravelWafeq::contacts()->destroyModel($customer);
```

Or mix `HasWafeqResource` into your model and call directly on the instance:

```php
use HWafeq\LaravelWafeq\Concerns\HasWafeqResource;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasWafeqResource;

    public static function wafeqResourceName(): string
    {
        return 'contacts';
    }
}

$customer = Customer::find(1);
$contact = $customer->wafeq()->retrieve();
```

The model-side and resource-side APIs share the same id-resolution precedence — see [Eloquent integration](./docs/eloquent-integration.md).

### Events

Every successful resource call dispatches a typed event you can listen to:

```php
use HWafeq\LaravelWafeq\Events\Contacts\ContactCreated;
use Illuminate\Support\Facades\Event;

Event::listen(ContactCreated::class, function (ContactCreated $event) {
    logger()->info('contact created', [
        'id'      => $event->id,
        'name'    => $event->data->name,
        'payload' => $event->payload,
    ]);
});
```

The full event inventory lives under [`HWafeq\LaravelWafeq\Events`](./docs/events.md) — one event per endpoint × resource (e.g. `ContactCreated`, `ContactListed`, `ContactRetrieved`, `ContactUpdated`, `ContactPartiallyUpdated`, `ContactDestroyed`).

### Error handling

Non-2xx responses are converted into typed exceptions under `HWafeq\LaravelWafeq\Exceptions`:

| Status | Exception                  | Notes                                                              |
|-------:|----------------------------|--------------------------------------------------------------------|
| 401/403 | `AuthenticationException` | Bad or missing API key.                                            |
| 404    | `NotFoundException`        | Resource doesn't exist.                                            |
| 422    | `ValidationException`      | `context['errors']` holds the field-level error map from Wafeq.    |
| 429    | `RateLimitException`       | `context['retry_after']` holds the `Retry-After` header value.      |
| 5xx    | `ServerException`          | Wafeq itself failed — Laravel HTTP client retried before throwing. |
| other  | `WafeqException`           | Catch-all.                                                         |

See [Error handling](./docs/error-handling.md) for the full hierarchy and `context` payloads.

---

## Features

### Resource map (44 resources)

The package exposes **44 resources** grouped by what they manage:

| Group | Resources |
|-------|-----------|
| **Org** | [organization](./docs/resources/organization.md) |
| **Contacts & People** | [contacts](./docs/resources/contacts.md), [employees](./docs/resources/employees.md), [beneficiaries](./docs/resources/beneficiaries.md), [branches](./docs/resources/branches.md) |
| **Sales** | [invoices](./docs/resources/invoices.md), [api-invoices](./docs/resources/api-invoices.md), [simplified-invoices](./docs/resources/simplified-invoices.md), [credit-notes](./docs/resources/credit-notes.md), [api-credit-notes](./docs/resources/api-credit-notes.md), [quotes](./docs/resources/quotes.md) |
| **Purchases** | [bills](./docs/resources/bills.md), [debit-notes](./docs/resources/debit-notes.md), [purchase-orders](./docs/resources/purchase-orders.md), [expenses](./docs/resources/expenses.md), [payment-requests](./docs/resources/payment-requests.md) |
| **Payments** | [payments](./docs/resources/payments.md), [payslips](./docs/resources/payslips.md) |
| **Banking** | [bank-accounts](./docs/resources/bank-accounts.md), [bank-ledger-transactions](./docs/resources/bank-ledger-transactions.md), [bank-statement-transactions](./docs/resources/bank-statement-transactions.md) |
| **Chart of accounts** | [accounts](./docs/resources/accounts.md), [tax-rates](./docs/resources/tax-rates.md), [cost-centers](./docs/resources/cost-centers.md), [warehouses](./docs/resources/warehouses.md), [projects](./docs/resources/projects.md), [custom-fields](./docs/resources/custom-fields.md), [units-of-measure](./docs/resources/units-of-measure.md), [item-units-of-measure](./docs/resources/item-units-of-measure.md), [items](./docs/resources/items.md) |
| **Line items** | [invoices-line-items](./docs/resources/invoices-line-items.md), [bills-line-items](./docs/resources/bills-line-items.md), [credit-notes-line-items](./docs/resources/credit-notes-line-items.md), [debit-notes-line-items](./docs/resources/debit-notes-line-items.md), [quotes-line-items](./docs/resources/quotes-line-items.md), [purchase-orders-line-items](./docs/resources/purchase-orders-line-items.md), [simplified-invoices-line-items](./docs/resources/simplified-invoices-line-items.md), [journal-line-items](./docs/resources/journal-line-items.md), [payslips-pay-items](./docs/resources/payslips-pay-items.md) |
| **Accounting** | [manual-journals](./docs/resources/manual-journals.md), [amortizations](./docs/resources/amortizations.md), [revenue-recognitions](./docs/resources/revenue-recognitions.md) |
| **Files & Reports** | [files](./docs/resources/files.md), [reports](./docs/resources/reports.md) |

Every resource is exposed via a dedicated interface under `HWafeq\LaravelWafeq\Contracts\*ResourceContract`, so you can type-hint the resource you actually use:

```php
use HWafeq\LaravelWafeq\Contracts\InvoicesResourceContract;

class BillingService
{
    public function __construct(private InvoicesResourceContract $invoices) {}

    public function resend(string $invoiceId): void
    {
        $this->invoices->partialUpdate($invoiceId, ['status' => 'open']);
    }
}
```

### Shared DTOs

Cross-resource types live under [`HWafeq\LaravelWafeq\Data\Shared`](./docs/dtos.md#shared-dtos):

| Shared DTO | Used by |
|------------|---------|
| `AccountRefData` | Line items that point at an account |
| `AddressData` | Postal addresses |
| `BranchRefData` | References to branches |
| `ContactRefData` | Line items / payments that point at a contact |
| `DimensionRefData` | Cost center / project references |
| `DualLangData` | `{en, ar}` value objects (warehouses, branches, contacts, accounts…) |
| `ItemRefData` | Line items that point at an item |
| `TaxRateRefData` | Line items that point at a tax rate |
| `UserRefData` | Wafeq user / employee references |
| `WarehouseRefData` | References to a Wafeq warehouse |

`DualLangData` is special — it implements Spatie Data's `Castable` contract so any property typed as `?DualLangData` will accept the Wafeq wire format (`{en: ..., ar: ...}`) **or** a bare string (wrapped as `{en: $string, ar: null}`) automatically.

### Enums

The package ships 19 typed enums in [`HWafeq\LaravelWafeq\Enums`](./docs/enums.md). All Wafeq-facing enums are sourced directly from the official `wafeq-docs` and implement Spatie Data's `Castable` so unknown wire values fall back to `null` instead of throwing.

```php
use HWafeq\LaravelWafeq\Enums\Currency;
use HWafeq\LaravelWafeq\Enums\ChargeType;
use HWafeq\LaravelWafeq\Enums\PaymentRequestStatus;

LaravelWafeq::paymentRequests()->create([
    'amount'      => '100.00',
    'currency'    => Currency::AED->value,            // 'AED'
    'charge_type' => ChargeType::Beneficiary->value,  // 'BEN'
]);

$status = LaravelWafeq::paymentRequests()->retrieve('abc')->status;
$status === PaymentRequestStatus::Processed->value;   // 'PROCESSED'
```

### Idempotency

Every mutating call (`create`, `update`, `partialUpdate`, `destroy`, plus resource-specific extras like `markAsPosted`, `invoice`, `bill`, `taxAuthorityReport`, `bulkSend`, `previewCreate`, etc.) automatically attaches a UUID `X-Wafeq-Idempotency-Key` header. Retries are safe — see [Idempotency](./docs/idempotency.md).

The header name is configurable via the `idempotency_header` config key.

---

## Testing

```bash
composer test
```

The test suite uses [Pest](https://pestphp.com) and ships an `FakesWafeq` trait that wraps Laravel's `Http::fake()` so you can stub every endpoint without touching the network:

```php
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('creates an invoice', function () {
    $this->fakeWafeq('/invoices/', ['id' => 'inv_1', 'total' => '100.00']);

    $invoice = LaravelWafeq::invoices()->create(['contact' => 'ct_1']);

    expect($invoice->id)->toBe('inv_1');
});
```

`FakesWafeq` also exposes `fakeWafeqPage()` (paginated list bodies), `fakeNotFound()`, `fakeValidationError()`, `fakeRateLimit()`, `fakeServerError()`, and `fakeAuthError()` for every HTTP failure the API returns. See [Testing](./docs/testing.md) for the full surface.

Run the test suite yourself:

```bash
./vendor/bin/pest                    # 396 passed (834 assertions)
./vendor/bin/phpstan analyse        # no errors
./vendor/bin/pint                   # clean
```

---

## Configuration

The package reads from `config/wafeq.php`. The defaults:

```php
return [
    // Sandbox for local development, production for live traffic.
    'environment' => env('WAFEQ_ENVIRONMENT', 'sandbox'),

    // Required. Generate one at https://app.wafeq.com/c/api-keys
    'api_key' => env('WAFEQ_API_KEY'),

    'base_urls' => [
        'sandbox'    => env('WAFEQ_SANDBOX_BASE_URL', 'https://api-sandbox.wafeq.com/v1'),
        'production' => env('WAFEQ_PRODUCTION_BASE_URL', 'https://api.wafeq.com/v1'),
    ],

    'http' => [
        'timeout'         => (int) env('WAFEQ_HTTP_TIMEOUT', 30),
        'connect_timeout' => (int) env('WAFEQ_HTTP_CONNECT_TIMEOUT', 10),
        'retry' => [
            'times' => (int) env('WAFEQ_RETRY_TIMES', 3),
            'delay' => (int) env('WAFEQ_RETRY_DELAY', 250),
            'when'  => [429, 503],
        ],
        'log' => env('WAFEQ_HTTP_LOG', false),
    ],

    'idempotency_header' => env('WAFEQ_IDEMPOTENCY_HEADER', 'X-Wafeq-Idempotency-Key'),
];
```

At minimum, set `WAFEQ_API_KEY` (and `WAFEQ_ENVIRONMENT=production` when you're ready for live traffic). See [Configuration](./docs/configuration.md) for the full reference.

---

## Documentation

The package ships comprehensive documentation under [`docs/`](./docs/index.md):

| Page | What it covers |
|------|----------------|
| [Getting started](./docs/getting-started.md) | Install, env, first call. |
| [Architecture](./docs/architecture.md) | `Connector → Client → Resource → DTO` pipeline; `HandlesResponses`, `InteractsWithModels`, `HoldsWafeqModel` traits. |
| [Configuration](./docs/configuration.md) | Every config key and env var explained. |
| [Idempotency](./docs/idempotency.md) | How the package protects mutating calls. |
| [Error handling](./docs/error-handling.md) | Exception hierarchy and status-code mapping. |
| [Eloquent integration](./docs/eloquent-integration.md) | Model-aware overloads, payload building, id resolution. |
| [Events](./docs/events.md) | Typed Laravel events dispatched from every Resource method. |
| [Enums](./docs/enums.md) | Every typed enum the package ships. |
| [DTOs](./docs/dtos.md) | Data Transfer Object conventions, `extra` catch-all, paginated envelopes, shared DTOs. |
| [Testing](./docs/testing.md) | The `FakesWafeq` trait and `WafeqFake` helper. |
| [Resources](./docs/resources/organization.md) | One page per resource family with curl-equivalent examples. |

---

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mohamed Habib](https://github.com/mohamedhabibwork)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
