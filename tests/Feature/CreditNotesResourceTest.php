<?php

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists credit notes', function () {
    $this->fakeWafeqPage('/credit-notes/', [
        ['id' => 'cn_1', 'creditNoteNumber' => 'CN-001', 'status' => 'OPEN', 'total' => '500.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::creditNotes()->list();

    expect($page->results[0])->toBeInstanceOf(CreditNoteData::class)
        ->and($page->results[0]->status)->toBe('OPEN');
});

it('creates a credit note', function () {
    $this->fakeWafeq('/credit-notes/', ['id' => 'cn_new', 'creditNoteNumber' => 'CN-002', 'status' => 'DRAFT', 'total' => '1000.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::creditNotes()->create([
        'contact' => 'c_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($cn->id)->toBe('cn_new');
});

it('retrieves a credit note', function () {
    $this->fakeWafeq('/credit-notes/cn_1/', ['id' => 'cn_1', 'creditNoteNumber' => 'CN-001', 'status' => 'OPEN', 'total' => '500.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::creditNotes()->retrieve('cn_1');

    expect($cn->id)->toBe('cn_1');
});

it('updates a credit note', function () {
    $this->fakeWafeq('/credit-notes/cn_1/', ['id' => 'cn_1', 'creditNoteNumber' => 'CN-001', 'status' => 'APPLIED', 'total' => '500.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::creditNotes()->update('cn_1', ['status' => 'APPLIED']);

    expect($cn->status)->toBe('APPLIED');
});

it('partial updates a credit note', function () {
    $this->fakeWafeq('/credit-notes/cn_1/', ['id' => 'cn_1', 'creditNoteNumber' => 'CN-001', 'status' => 'APPLIED', 'total' => '500.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::creditNotes()->partialUpdate('cn_1', ['status' => 'APPLIED']);

    expect($cn->status)->toBe('APPLIED');
});

it('destroys a credit note', function () {
    $this->fakeWafeq('/credit-notes/cn_1/', '', 204);

    expect(LaravelWafeq::creditNotes()->destroy('cn_1'))->toBeTrue();
});

it('downloads a credit note', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/credit-notes/cn_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::creditNotes()->download('cn_1');

    expect($response->body())->toBe('PDF');
});

it('generates a tax authority report', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/credit-notes/cn_1/tax_authority_report/*' => Http::response('{"status":"submitted"}', 200, ['Content-Type' => 'application/json']),
    ]);

    $response = LaravelWafeq::creditNotes()->taxAuthorityReport('cn_1', ['type' => 'vat']);

    expect($response->body())->toContain('submitted');
});
