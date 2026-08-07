<?php

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists simplified invoices', function () {
    $this->fakeWafeqPage('/simplified-invoices/', [
        ['id' => 'si_1', 'invoiceNumber' => 'SI-001', 'status' => 'OPEN', 'total' => '150.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::simplifiedInvoices()->list();

    expect($page->results[0])->toBeInstanceOf(SimplifiedInvoiceData::class)
        ->and($page->results[0]->status)->toBe('OPEN');
});

it('creates a simplified invoice', function () {
    $this->fakeWafeq('/simplified-invoices/', ['id' => 'si_new', 'invoiceNumber' => 'SI-002', 'status' => 'DRAFT', 'total' => '300.00', 'currency' => 'SAR']);

    $si = LaravelWafeq::simplifiedInvoices()->create([
        'contact' => 'c_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($si->id)->toBe('si_new');
});

it('retrieves a simplified invoice', function () {
    $this->fakeWafeq('/simplified-invoices/si_1/', ['id' => 'si_1', 'invoiceNumber' => 'SI-001', 'status' => 'OPEN', 'total' => '150.00', 'currency' => 'SAR']);

    $si = LaravelWafeq::simplifiedInvoices()->retrieve('si_1');

    expect($si->id)->toBe('si_1');
});

it('updates a simplified invoice', function () {
    $this->fakeWafeq('/simplified-invoices/si_1/', ['id' => 'si_1', 'invoiceNumber' => 'SI-001', 'status' => 'PAID', 'total' => '150.00', 'currency' => 'SAR']);

    $si = LaravelWafeq::simplifiedInvoices()->update('si_1', ['status' => 'PAID']);

    expect($si->status)->toBe('PAID');
});

it('partial updates a simplified invoice', function () {
    $this->fakeWafeq('/simplified-invoices/si_1/', ['id' => 'si_1', 'invoiceNumber' => 'SI-001', 'status' => 'OVERDUE', 'total' => '150.00', 'currency' => 'SAR']);

    $si = LaravelWafeq::simplifiedInvoices()->partialUpdate('si_1', ['status' => 'OVERDUE']);

    expect($si->status)->toBe('OVERDUE');
});

it('destroys a simplified invoice', function () {
    $this->fakeWafeq('/simplified-invoices/si_1/', '', 204);

    expect(LaravelWafeq::simplifiedInvoices()->destroy('si_1'))->toBeTrue();
});

it('downloads a simplified invoice', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/simplified-invoices/si_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::simplifiedInvoices()->download('si_1');

    expect($response->body())->toBe('PDF');
});

it('generates a tax authority report', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/simplified-invoices/si_1/tax_authority_report/*' => Http::response('{"status":"queued"}', 200, ['Content-Type' => 'application/json']),
    ]);

    $response = LaravelWafeq::simplifiedInvoices()->taxAuthorityReport('si_1', ['type' => 'vat']);

    expect($response->body())->toContain('queued');
});
