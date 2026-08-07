<?php

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Exceptions\AuthenticationException;
use HWafeq\LaravelWafeq\Exceptions\NotFoundException;
use HWafeq\LaravelWafeq\Exceptions\ValidationException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists invoices as paginated data', function () {
    $this->fakeWafeqPage('/invoices/', [
        ['id' => 'inv_1', 'invoiceNumber' => 'INV-001', 'status' => 'OPEN', 'total' => '1000.00', 'amountDue' => '1000.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15', 'dueDate' => '2024-02-15', 'taxAmountType' => 'TAX_INCLUSIVE'],
        ['id' => 'inv_2', 'invoiceNumber' => 'INV-002', 'status' => 'PAID', 'total' => '500.00', 'amountDue' => '0.00', 'currency' => 'SAR', 'issueDate' => '2024-01-16', 'dueDate' => '2024-02-16', 'taxAmountType' => 'TAX_EXCLUSIVE'],
    ]);

    $page = LaravelWafeq::invoices()->list();

    expect($page->count)->toBe(2)
        ->and($page->results[0])->toBeInstanceOf(InvoiceData::class)
        ->and($page->results[0]->invoiceNumber)->toBe('INV-001')
        ->and($page->results[0]->taxAmountType)->toBe('TAX_INCLUSIVE')
        ->and($page->results[1]->status)->toBe('PAID');
});

it('forwards filter query parameters when listing invoices', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/invoices/*' => Http::response([
            'count' => 0, 'next' => null, 'previous' => null, 'results' => [],
        ]),
    ]);

    LaravelWafeq::invoices()->list(['status' => 'OPEN', 'currency' => 'SAR', 'expand' => 'contact']);

    Http::assertSent(function ($request) {
        return $request->method() === 'GET'
            && str_contains($request->url(), '/invoices/')
            && $request->data() === ['status' => 'OPEN', 'currency' => 'SAR', 'expand' => 'contact'];
    });
});

it('creates an invoice', function () {
    $this->fakeWafeq('/invoices/', ['id' => 'inv_new', 'invoiceNumber' => 'INV-003', 'status' => 'DRAFT', 'total' => '1500.00', 'currency' => 'SAR']);

    $invoice = LaravelWafeq::invoices()->create([
        'contact' => 'c_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($invoice)->toBeInstanceOf(InvoiceData::class)
        ->and($invoice->id)->toBe('inv_new')
        ->and($invoice->status)->toBe('DRAFT');
});

it('creates an invoice with the idempotency header', function () {
    $this->fakeWafeq('/invoices/', ['id' => 'inv_new', 'invoiceNumber' => 'INV-003', 'status' => 'DRAFT', 'total' => '1500.00', 'currency' => 'SAR']);

    LaravelWafeq::invoices()->create(['contact' => 'c_1', 'currency' => 'SAR']);

    Http::assertSent(function ($request) {
        return $request->method() === 'POST'
            && str_contains($request->url(), '/invoices/')
            && $request->hasHeader('X-Wafeq-Idempotency-Key');
    });
});

it('retrieves a single invoice', function () {
    $this->fakeWafeq('/invoices/inv_1/', ['id' => 'inv_1', 'invoiceNumber' => 'INV-001', 'status' => 'OPEN', 'total' => '1000.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15']);

    $invoice = LaravelWafeq::invoices()->retrieve('inv_1');

    expect($invoice->id)->toBe('inv_1')
        ->and($invoice->issueDate)->toBe('2024-01-15');
});

it('updates an invoice', function () {
    $this->fakeWafeq('/invoices/inv_1/', ['id' => 'inv_1', 'invoiceNumber' => 'INV-001', 'status' => 'PAID', 'total' => '1000.00', 'currency' => 'SAR']);

    $invoice = LaravelWafeq::invoices()->update('inv_1', ['status' => 'PAID']);

    expect($invoice->status)->toBe('PAID');
});

it('partial updates an invoice', function () {
    $this->fakeWafeq('/invoices/inv_1/', ['id' => 'inv_1', 'invoiceNumber' => 'INV-001', 'status' => 'PARTIALLY_PAID', 'total' => '1000.00', 'currency' => 'SAR']);

    $invoice = LaravelWafeq::invoices()->partialUpdate('inv_1', ['status' => 'PARTIALLY_PAID']);

    expect($invoice->status)->toBe('PARTIALLY_PAID');
});

it('destroys an invoice', function () {
    $this->fakeWafeq('/invoices/inv_1/', '', 204);

    expect(LaravelWafeq::invoices()->destroy('inv_1'))->toBeTrue();
});

it('downloads an invoice', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/invoices/inv_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::invoices()->download('inv_1');

    expect($response->body())->toBe('PDF');
});

it('generates a tax authority report', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/invoices/inv_1/tax_authority_report/*' => Http::response('{"status":"queued"}', 200, ['Content-Type' => 'application/json']),
    ]);

    $response = LaravelWafeq::invoices()->taxAuthorityReport('inv_1', ['type' => 'vat']);

    expect($response->body())->toContain('queued');
});

it('throws AuthenticationException on 401', function () {
    $this->fakeAuthError('/invoices/');

    LaravelWafeq::invoices()->list();
})->throws(AuthenticationException::class);

it('throws NotFoundException on 404', function () {
    $this->fakeNotFound('/invoices/inv_missing/');

    LaravelWafeq::invoices()->retrieve('inv_missing');
})->throws(NotFoundException::class);

it('throws ValidationException on 422 with errors', function () {
    $this->fakeValidationError('/invoices/', ['currency' => ['Required.']]);

    try {
        LaravelWafeq::invoices()->create([]);
    } catch (ValidationException $e) {
        expect($e->errors())->toBe(['currency' => ['Required.']])
            ->and($e->statusCode)->toBe(422);

        return;
    }

    test()->fail('Expected ValidationException');
});
