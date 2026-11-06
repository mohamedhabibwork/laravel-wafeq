# Laravel Wafeq

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohamedhabibwork/laravel-wafeq.svg?style=flat-square)](https://packagist.org/packages/mohamedhabibwork/laravel-wafeq)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mohamedhabibwork/laravel-wafeq/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mohamedhabibwork/laravel-wafeq/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mohamedhabibwork/laravel-wafeq/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mohamedhabibwork/laravel-wafeq/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mohamedhabibwork/laravel-wafeq.svg?style=flat-square)](https://packagist.org/packages/mohamedhabibwork/laravel-wafeq)

A typed Laravel client for the [Wafeq](https://wafeq.com) accounting API. Every endpoint is exposed as a resource behind a single `LaravelWafeq` facade, returning [`spatie/laravel-data`](https://github.com/spatie/laravel-data) DTOs so you get autocompletion, immutability and validation on every response.

> **44 resources. 120 FormRequests. 19 typed enums. 11 shared DTOs. Zero magic.**
> [Installation](#installation) · [Usage](#usage) · [Features](#features) · [Documentation](#documentation) · [llms.txt](./llms.txt)

---

## Why this package

- **One facade, every Wafeq endpoint** — `LaravelWafeq::contacts()`, `LaravelWafeq::invoices()`, `LaravelWafeq::bankAccounts()`, … each method returns a typed resource that maps to a specific Wafeq endpoint family.
- **Typed DTOs everywhere** — built on [`spatie/laravel-data`](https://github.com/spatie/laravel-data) with full PHPDoc, `readonly` properties and an `extra` catch-all so the package survives Wafeq schema additions without breaking your code.
- **Idempotent by default** — every mutating call (`POST` / `PUT` / `PATCH` / `DELETE`) automatically attaches a UUID idempotency header, so retries are safe.
- **Built on Laravel's HTTP client** — retries (`429`, `503`), timeouts, logging, and any custom middleware slot into the standard `Http::` pipeline.
- **Spatie Data name mapping** — DTO properties are camelCase but Wafeq's wire format is snake_case; the package transparently maps between them via Spatie Data's `SnakeCaseMapper`.
- **Localized fields handled** — `{en, ar}` Wafeq payloads hydrate into a dedicated `DualLangData` value object that implements Spatie Data's `Castable` so bare strings, arrays, or existing instances all work.
- **Typed enum casts** — enums such as `Currency` and `BillStatus` are used as DTO property types, and `LenientEnumCast` (in `src/Casts`) maps unknown wire values to `null` instead of throwing.
- **FormRequest layer out of the box** — every mutating endpoint (`create` / `update` / `partialUpdate` / `markAs*` / `taxAuthorityReport` / `bulkSend` / `invoice` / `bill` / `preview*` / `endEarly*`) ships a typed `FormRequest` under [`HWafeq\LaravelWafeq\Requests`](./src/Requests) that wires Laravel validation directly to the matching `spatie/laravel-data` DTO. Validate → `->toDto()` → hand off to the resource.
- **Eloquent bridge** — pass any `Model` into the `*Model()` overloads (or mix `HasWafeqResource` in and call `$customer->wafeq()->retrieve()`) and the package resolves the Wafeq id and builds the payload for you.
- **First-class test helpers** — `FakesWafeq` trait + `WafeqFake` helper stub every endpoint without touching the network.
- **Typed events** — every successful resource call dispatches a `WafeqEvent` subclass you can listen to for syncing, notifications, audit logs, etc.
- **ZATCA e-invoicing** — `LaravelWafeq::zatca()` covers the Wafeq ZATCA API end to end: B2B clearance, B2C reporting, platform / white-label connected accounts, device onboarding and the Fatoora **simulation** environment. See [ZATCA e-invoicing](#zatca-e-invoicing).

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

### Validated payloads with FormRequests

Every mutating endpoint ships a typed FormRequest that derives its rules straight from `wafeq-docs/<resource>_<action>.md`. Drop one into a controller and Laravel takes care of validation, attribute names, and the typed DTO hand-off:

```php
use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Requests\Expenses\CreateExpenseRequest;

class ExpenseController
{
    public function store(CreateExpenseRequest $request)
    {
        /** @var ExpenseData $expense */
        $expense = LaravelWafeq::expenses()->create($request->toDto()->toArray());

        return response()->json($expense, 201);
    }
}
```

Every FormRequest exposes:

- `rules()` — Laravel validation rules derived from the matching OpenAPI schema (required fields, `string` / `numeric` / `date_format:Y-m-d` / `in:v1,v2,...` etc.; server-managed `readOnly` fields are excluded).
- `attributes()` — human-friendly keys for nicer validation error messages.
- `dto(): class-string<Data>` — the matching `spatie/laravel-data` DTO.
- `toDto(): Data` — materialises the DTO from the validated payload in one call.

The full catalogue (120 FormRequests across every endpoint that takes a body — `create`, `update`, `partialUpdate`, plus special actions like `markAsDraft`, `markAsPosted`, `taxAuthorityReport`, `bulkSend`, `bill`, `invoice`, `previewCreate`, `endEarly`, `previewEndEarly`) lives under [`HWafeq\LaravelWafeq\Requests`](./src/Requests). All extend [`HWafeq\LaravelWafeq\Requests\WafeqFormRequest`](./src/Requests/WafeqFormRequest.php), which provides the `dto()` / `toDto()` plumbing.

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

The model-side and resource-side APIs share the same id-resolution precedence — see [`src/Concerns`](./src/Concerns).

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

The full event inventory lives under [`HWafeq\LaravelWafeq\Events`](./src/Events) — one event per endpoint × resource (e.g. `ContactCreated`, `ContactListed`, `ContactRetrieved`, `ContactUpdated`, `ContactPartiallyUpdated`, `ContactDestroyed`).

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

See the classes under [`src/Exceptions`](./src/Exceptions) for the full hierarchy and `context` payloads.

### ZATCA e-invoicing

`LaravelWafeq::zatca()` wraps the [Wafeq ZATCA API](https://docs.wafeq.com/zatca/wafeq-public-api-vs-zatca-api) for standalone Saudi e-invoicing (Phase 2). The client is **immutable**: `simulation()`, `production()`, `forBranch()` and `forConnectedAccount()` each return a re-scoped copy, which sends the matching `X-ZATCA-Environment`, `X-ZATCA-Branch` and `X-ZATCA-Connected-Account-Id` headers.

**Simulation first.** The default environment is `simulation` (the Fatoora simulation portal: nothing reaches the tax authority). Switch with `WAFEQ_ZATCA_ENVIRONMENT=production` or `->production()` per call.

```php
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;

$zatca = LaravelWafeq::zatca(); // simulation by default

// 1. Onboard a device with an OTP from the Fatoora portal (valid for 1 hour).
$device = $zatca->devices()->register('POS 1', '454230');
$device->isActive(); // true
```

**B2C** ([guide](https://docs.wafeq.com/zatca/for-b2c)): simplified invoices and refunds. Add `channels` to deliver the document to the customer in the same request.

```php
$invoice = $zatca->simplifiedInvoices()->report($document, [
    'channels'  => [['medium' => 'email', 'data' => [
        'recipients' => ['to' => ['customer@example.com']],
        'subject'    => 'Your invoice',
        'message'    => 'Thank you for your purchase.',
    ]]],
    'reference' => 'order-42',
]);

$invoice->id();          // "zdoc_…"
$invoice->qrCodeData;    // base64 TLV for the receipt
$invoice->isReported();  // true

$zatca->simplifiedCreditNotes()->report($refund);

// Asynchronous: signed XML + QR returned immediately (202), reporting queued.
$zatca->simplifiedInvoices()->issue($document);
```

**B2B** ([guide](https://docs.wafeq.com/zatca/for-b2b)): standard invoices and credit notes are cleared by ZATCA.

```php
$zatca->production()->invoices()->report($document);
$zatca->production()->creditNotes()->report($creditNote);
```

**Platforms / white label** ([guide](https://docs.wafeq.com/zatca/for-platforms-or-white-label)): onboard each customer as a connected account, then act on their behalf.

```php
$account = $zatca->connectedAccounts()->create([
    'name'                    => 'ABCD Inc',
    'address'                 => 'Anas Bin Malik, Al Malqa',
    'city'                    => 'Riyadh',
    'country'                 => 'SA',
    'business_category'       => 'Manufacturing',
    'tax_registration_number' => '311111111111113',
]);

$customer = $zatca->production()->forConnectedAccount($account->id);

$customer->devices()->register('Device 1', $otpFromCustomer);
$customer->invoices()->report($document); // supplier.identification.value = customer's CRN
```

**Group VAT / branches**: `$zatca->forBranch('3125678939')` scopes device registration and reporting to a Group VAT member's TIN (or a branch name).

Every document family (`invoices`, `creditNotes`, `debitNotes`, `prepaymentInvoices`, `simplifiedInvoices`, `simplifiedCreditNotes`, `simplifiedDebitNotes`, `prepaymentSimplifiedInvoices`, or `documents(ZatcaDocumentType::…)`) exposes:

| Method | Endpoint |
|---|---|
| `report($document, $options)` / `validate(…)` | `POST …/report/`, `…/validate/` |
| `bulkReport($payloads)` / `bulkValidate(…)` | `POST …/bulk-report/`, `…/bulk-validate/` |
| `issue(…)` / `bulkIssue(…)` *(simplified only)* | `POST …/issue/`, `…/bulk-issue/` |
| `list($query)` / `retrieve($id)` | `GET …/`, `…/{id}/` |
| `updateMetadata($id, $metadata)` | `PATCH …/{id}/` |
| `download($id, ZatcaDownloadType::Pdf, regenerate: false)` | `GET …/{id}/download/` (PDF/A-3 or XML) |
| `retry($id)` | `POST …/{id}/retry/` (for `ERROR` documents) |
| `send($id, $payload)` | `POST …/{id}/send/` |

Also available: `devices()->list() / retrieve() / renew($id, $otp) / revoke($id)`, `connectedAccounts()` CRUD, and `usage()->retrieve()` for remaining document credits (`ZatcaUsageData::isBlocked()`).

ZATCA errors map onto the same exception hierarchy:

| Status | Exception | Notes |
|---:|---|---|
| 400 | `ZatcaValidationException` (extends `ValidationException`) | Invalid payload, failed ZATCA rules or a duplicate document. `zatcaErrors()` lists `{code, detail, attr}`. |
| 403 | `AuthenticationException` | No active device, or a missing / invalid environment. |
| 424 | `ZatcaSubmissionException` | Wafeq accepted the document but reporting / clearance with ZATCA failed. |
| — | `ZatcaConfigurationException` | Thrown before sending, e.g. a `zatca_live_` key used with `simulation()`. |

ZATCA requests send no idempotency key and are retried only on connection errors and `http.retry.when` statuses (429 / 503), so a rejected report is never silently resubmitted. Events: `ZatcaDocumentReported`, `ZatcaDocumentIssued`, `ZatcaDeviceRegistered`, `ZatcaConnectedAccountCreated` (under `HWafeq\LaravelWafeq\Events\Zatca`).

#### Typed ZATCA documents

Instead of raw arrays, build documents with the DTOs under `HWafeq\LaravelWafeq\Data\Zatca\Payload`. They serialise to the snake_case wire format with unset optional fields dropped, and every resource method accepts them anywhere it accepts an array.

```php
use HWafeq\LaravelWafeq\Data\Zatca\Payload\{ZatcaAddressData, ZatcaChannelData, ZatcaDeliveryOptionsData, ZatcaDocumentPayloadData, ZatcaLineItemData, ZatcaPartyIdentificationData, ZatcaSupplierData, ZatcaTaxData};
use HWafeq\LaravelWafeq\Enums\Currency;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaExemptionReason;

$document = new ZatcaDocumentPayloadData(
    documentNumber: 'INV-0001',
    currency: Currency::SAR,
    supplyDate: '2026-11-06',
    supplier: new ZatcaSupplierData(
        name: 'ABCD Inc',
        address: new ZatcaAddressData(street: 'Anas Bin Malik', building: '3141', city: 'Riyadh', district: 'Al Malqa', postalCode: '13521'),
        identification: ZatcaPartyIdentificationData::commercialRegistration('1234567890'),
    ),
    lineItems: [
        ZatcaLineItemData::make('iPhone 15 Pro', quantity: 1, unitPrice: 4699),                       // 15% standard VAT
        ZatcaLineItemData::make('Export service', quantity: 1, unitPrice: 500,
            tax: ZatcaTaxData::zeroRated(ZatcaExemptionReason::ExportOfServices)),
    ],
    taxTotal: 704.85,
    // customer: defaults to an anonymous B2C buyer
);

$zatca->simplifiedInvoices()->report($document, new ZatcaDeliveryOptionsData(
    channels: [ZatcaChannelData::email('customer@example.com', 'Your invoice', 'Thank you!')],
));
```

New enums cover the document vocabulary: `ZatcaTaxCategory`, `ZatcaExemptionReason` (with `category()`), `ZatcaCustomerIdentificationType`, `ZatcaSupplierIdentificationType`, `ZatcaDocumentIndicator`, `ZatcaTaxAmountType` and `ZatcaLanguage`. The longer code lists (countries, charge / discount reasons, payment means) live in `Support\Zatca\ZatcaCodeLists`.

#### ZATCA FormRequests

`HWafeq\LaravelWafeq\Requests\Zatca` ships one FormRequest per document family (`ReportZatcaInvoiceRequest`, `ReportZatcaCreditNoteRequest`, … `ReportZatcaPrepaymentSimplifiedInvoiceRequest`). The same body serves `report`, `validate` and `issue`. Rules follow the ZATCA schema for each family: B2B customers need a name and address, notes need `reference_document_number` and a `payment_means` issue reason, non-standard VAT needs an exemption reason, and so on. `toDto()` returns a `ZatcaReportRequestData` that you pass straight to the resource:

```php
public function store(ReportZatcaSimplifiedInvoiceRequest $request)
{
    return LaravelWafeq::zatca()->simplifiedInvoices()->report($request->toDto());
}
```

Also available: `SendZatcaDocumentRequest`, `UpdateZatcaDocumentMetadataRequest`, `RegisterZatcaDeviceRequest`, `RenewZatcaDeviceRequest` and `Create` / `Update` / `PartialUpdateZatcaConnectedAccountRequest`.

#### Testing your ZATCA integration

`HWafeq\LaravelWafeq\Testing\ZatcaFake` fakes every ZATCA endpoint offline. Responses echo the request: a reported document keeps its number, reference and metadata, validation computes totals from the line items, and a registered device belongs to the request's branch / connected account.

```php
use HWafeq\LaravelWafeq\Testing\ZatcaFake;

ZatcaFake::fake([
    // Optional overrides: path relative to /zatca/, optional HTTP method, * wildcards.
    'simplified-invoices/report/' => ZatcaFake::validationError('Invalid VAT number.', 'document.supplier'),
    'POST invoices/*'             => ZatcaFake::submissionError('Clearance rejected.'),
    'devices/register/'           => ZatcaFake::noActiveDevice(),
]);

// … exercise your code …

ZatcaFake::assertReported(ZatcaDocumentType::SimplifiedInvoice, fn (array $body) => $body['reference'] === 'order-42');
ZatcaFake::assertIssued(ZatcaDocumentType::SimplifiedInvoice);
ZatcaFake::assertNothingReported();
ZatcaFake::assertDeviceRegistered();
ZatcaFake::assertSentToEnvironment(ZatcaEnvironment::Simulation);
ZatcaFake::assertSentForConnectedAccount('ca_123');
```

Response builders for custom overrides: `ZatcaFake::document()`, `device()`, `connectedAccount()`, `usage()`, `page()`, `rateLimited()` and `serverError()`. Requests to non-ZATCA URLs fall through to your other `Http::fake()` stubs.

---

## Features

### Resource map (44 resources)

The package exposes **44 resources** grouped by what they manage:

| Group | Resources |
|-------|-----------|
| **Org** | `organization()` |
| **Contacts & People** | `contacts()`, `employees()`, `beneficiaries()`, `branches()` |
| **Sales** | `invoices()`, `apiInvoices()`, `simplifiedInvoices()`, `creditNotes()`, `apiCreditNotes()`, `quotes()` |
| **Purchases** | `bills()`, `debitNotes()`, `purchaseOrders()`, `expenses()`, `paymentRequests()` |
| **Payments** | `payments()`, `payslips()` |
| **Banking** | `bankAccounts()`, `bankLedgerTransactions()`, `bankStatementTransactions()` |
| **Chart of accounts** | `accounts()`, `taxRates()`, `costCenters()`, `warehouses()`, `projects()`, `customFields()`, `unitsOfMeasure()`, `itemUnitsOfMeasure()`, `items()` |
| **Line items** | `invoicesLineItems()`, `billsLineItems()`, `creditNotesLineItems()`, `debitNotesLineItems()`, `quotesLineItems()`, `purchaseOrdersLineItems()`, `simplifiedInvoicesLineItems()`, `journalLineItems()`, `payslipsPayItems()` |
| **Accounting** | `manualJournals()`, `amortizations()`, `revenueRecognitions()` |
| **Files & Reports** | `files()`, `reports()` |

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

Cross-resource types live under [`HWafeq\LaravelWafeq\Data\Shared`](./src/Data/Shared):

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

The package ships typed enums in [`HWafeq\LaravelWafeq\Enums`](./src/Enums), sourced from the official `wafeq-docs`. Wafeq enums are wired into DTOs through `LenientEnumCast`, so unknown wire values fall back to `null` instead of throwing.

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

### Default currency

Set `WAFEQ_CURRENCY` (or `config/wafeq.php` → `currency`) to your organisation's base currency. When the value is `null`, the package fetches the base currency from `GET /organization/` and caches it for the rest of the request lifecycle.

```dotenv
WAFEQ_CURRENCY=AED
```

Tag DTO properties with `#[WithCurrency]` to auto-fill them from the default when the wire payload is missing or unknown:

```php
use HWafeq\LaravelWafeq\Attributes\WithCurrency;
use HWafeq\LaravelWafeq\Enums\Currency;

class InvoiceData extends Data
{
    public function __construct(
        public string $id = '',
        #[WithCurrency]
        public ?Currency $currency = null,
        // ...
    ) {}
}
```

A wire response shaped `{ "id": "inv_123" }` now hydrates with `Currency::AED` automatically. A response shaped `{ "id": "inv_123", "currency": "USD" }` becomes `Currency::USD`. The fill runs once after every response hydration (via `HandlesResponses::toData()`) and is a no-op when the property already has a value.

```php
$client = app(\HWafeq\LaravelWafeq\Contracts\ClientContract::class);
$default = $client->defaultCurrency();   // returns the resolved Currency (or null)
```

### Idempotency

Every mutating call (`create`, `update`, `partialUpdate`, `destroy`, plus resource-specific extras like `markAsPosted`, `invoice`, `bill`, `taxAuthorityReport`, `bulkSend`, `previewCreate`, etc.) automatically attaches a UUID `X-Wafeq-Idempotency-Key` header. Retries are safe.

The header name is configurable via the `idempotency_header` config key.

### FormRequest layer

Every endpoint that accepts a request body ships a typed Laravel FormRequest under [`HWafeq\LaravelWafeq\Requests`](./src/Requests). The validation rules are derived directly from the matching `wafeq-docs/<resource>_<action>.md` OpenAPI schema, so the package and the docs stay in lock-step:

| Endpoint family | FormRequests |
|-----------------|--------------|
| `*_create.md`  | `Create<Resource>Request` (one per resource) |
| `*_update.md`  | `Update<Resource>Request` |
| `*_partial_update.md` | `PartialUpdate<Resource>Request` (every field becomes `sometimes` + `nullable`) |
| Special actions | `CreateMarkAsDraftExpenseRequest`, `CreateMarkAsPostedExpenseRequest`, `CreateInvoiceTaxAuthorityReportRequest`, `CreateApiInvoiceBulkSendRequest`, `CreateQuoteInvoiceRequest`, `CreatePurchaseOrderBillRequest`, `CreateAmortizationPreviewRequest`, `CreateAmortizationEndEarlyRequest`, `CreateRevenueRecognitionPreviewRequest`, … |

**120 FormRequests total** (one per endpoint in `wafeq-docs/` that takes a request body), plus the `WafeqFormRequest` base class.

All 120 FormRequests extend a single base class:

```php
namespace HWafeq\LaravelWafeq\Requests;

abstract class WafeqFormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function authorize(): bool { return true; }

    /** @return array<string, array<int, mixed>> */
    abstract public function rules(): array;

    /** @return class-string<\Spatie\LaravelData\Data> */
    abstract public function dto(): string;

    public function toDto(): \Spatie\LaravelData\Data
    {
        /** @var class-string<\Spatie\LaravelData\Data> $dto */
        $dto = $this->dto();

        return $dto::from($this->validated());
    }
}
```

#### JSON Schema → Laravel rules

The mapping rules are consistent across every FormRequest:

| OpenAPI schema                                      | Laravel rule                              |
|-----------------------------------------------------|-------------------------------------------|
| `{"type": "string", "maxLength": 255}`              | `['nullable', 'string', 'max:255']`       |
| `{"type": "number", "format": "double"}`            | `['required', 'numeric']` (or `nullable`)  |
| `{"type": "string", "format": "date"}`              | `'date_format:Y-m-d'`                      |
| `{"type": "string", "format": "date-time"}`         | `'date_format:Y-m-d\TH:i:sP'`              |
| `{"type": "array", "items": {"type": "string"}}`    | `['sometimes', 'array']` + `['KEY.*', 'string']` |
| `$ref` to `CurrencyEnum` / `ClassificationEnum`     | read the enum under `src/Enums/` to derive `in:v1,v2,...` |
| `{"readOnly": true}`                                | EXCLUDE (server-managed only)             |
| `default: "X"`, field optional                      | `['sometimes', ...]`                      |
| `partial_update.md` body                            | every field becomes `['sometimes', 'nullable', ...]` |
| Bodyless endpoint (`mark_as_*`, `tax_authority_report_*`, `bulk_send_*`, `bill_create`, `invoice_create`, `preview_*`, `end_early_*`) | `rules()` returns `[]`; `dto()` still wired |

#### Wire-format caveats

- **snake_case** on input, camelCase on the DTO — the package's `SnakeCaseMapper` handles the bidirectional translation, so you can pass either form to `toDto()`.
- **Dual-language fields** (branches / warehouses `name`, `city`, `district`, `address`): wire format `{en: required, ar: nullable}`. The matching FormRequest validates `parent.array` + `name.en` `required` + `name.ar` `nullable`; the array is then hydrated into `DualLangData` by the DTO's cast.
- **Bodyless endpoints** ship an empty `rules()` array but still implement `dto()` so `toDto()->toArray()` always returns a usable payload.

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

`FakesWafeq` also exposes `fakeWafeqPage()` (paginated list bodies), `fakeNotFound()`, `fakeValidationError()`, `fakeRateLimit()`, `fakeServerError()`, and `fakeAuthError()` for every HTTP failure the API returns. See [`FakesWafeq`](./tests/Pests/Concerns/FakesWafeq.php) for the full surface.

Run the test suite yourself:

```bash
./vendor/bin/pest
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

    // ZATCA e-invoicing — see "ZATCA e-invoicing" above.
    'zatca' => [
        'environment'       => env('WAFEQ_ZATCA_ENVIRONMENT', 'simulation'), // or "production"
        'api_key'           => env('WAFEQ_ZATCA_API_KEY'),                   // optional zatca_live_… / zatca_sim_… key; falls back to api_key
        'base_url'          => env('WAFEQ_ZATCA_BASE_URL', 'https://api.wafeq.com/v1'),
        'branch'            => env('WAFEQ_ZATCA_BRANCH'),                    // default X-ZATCA-Branch
        'connected_account' => env('WAFEQ_ZATCA_CONNECTED_ACCOUNT'),         // default X-ZATCA-Connected-Account-Id
    ],
];
```

At minimum, set `WAFEQ_API_KEY` (and `WAFEQ_ENVIRONMENT=production` when you're ready for live traffic). See [`config/wafeq.php`](./config/wafeq.php) for the full reference.

---

## Documentation

Documentation lives in this README and in the source and spec folders linked below:

| Topic | Where to look |
|-------|---------------|
| Installation and configuration | [Installation](#installation) and [`config/wafeq.php`](./config/wafeq.php) |
| Architecture | [`src/Connector.php`](./src/Connector.php), [`src/Client.php`](./src/Client.php), [`src/Concerns`](./src/Concerns) |
| Idempotency | [Features](#idempotency) |
| Error handling | [Error handling](#error-handling) and [`src/Exceptions`](./src/Exceptions) |
| Eloquent integration | [Eloquent bridge](#eloquent-bridge) and [`src/Concerns`](./src/Concerns) |
| Events | [Events](#events) and [`src/Events`](./src/Events) |
| Enums | [`src/Enums`](./src/Enums) |
| DTOs | [`src/Data`](./src/Data) and [`src/Data/Shared`](./src/Data/Shared) |
| FormRequests | [FormRequest layer](#formrequest-layer) and [`src/Requests`](./src/Requests) |
| Testing | [Testing](#testing) and [`FakesWafeq`](./tests/Pests/Concerns/FakesWafeq.php) |
| Wafeq API specs | [`wafeq-docs/`](./wafeq-docs) |
| LLM index | [`llms.txt`](./llms.txt) |

---

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions are welcome. Please open an issue or a pull request on GitHub.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mohamed Habib](https://github.com/mohamedhabibwork)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
