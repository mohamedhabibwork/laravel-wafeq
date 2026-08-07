<?php

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists quotes', function () {
    $this->fakeWafeqPage('/quotes/', [
        ['id' => 'q_1', 'quoteNumber' => 'Q-001', 'status' => 'SENT', 'total' => '1000.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15', 'expiryDate' => '2024-02-15'],
    ]);

    $page = LaravelWafeq::quotes()->list();

    expect($page->results[0])->toBeInstanceOf(QuoteData::class)
        ->and($page->results[0]->status)->toBe('SENT');
});

it('creates a quote', function () {
    $this->fakeWafeq('/quotes/', ['id' => 'q_new', 'quoteNumber' => 'Q-002', 'status' => 'DRAFT', 'total' => '500.00', 'currency' => 'SAR']);

    $q = LaravelWafeq::quotes()->create([
        'contact' => 'c_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($q->id)->toBe('q_new');
});

it('retrieves a quote', function () {
    $this->fakeWafeq('/quotes/q_1/', ['id' => 'q_1', 'quoteNumber' => 'Q-001', 'status' => 'SENT', 'total' => '1000.00', 'currency' => 'SAR']);

    $q = LaravelWafeq::quotes()->retrieve('q_1');

    expect($q->id)->toBe('q_1');
});

it('updates a quote', function () {
    $this->fakeWafeq('/quotes/q_1/', ['id' => 'q_1', 'quoteNumber' => 'Q-001', 'status' => 'ACCEPTED', 'total' => '1000.00', 'currency' => 'SAR']);

    $q = LaravelWafeq::quotes()->update('q_1', ['status' => 'ACCEPTED']);

    expect($q->status)->toBe('ACCEPTED');
});

it('partial updates a quote', function () {
    $this->fakeWafeq('/quotes/q_1/', ['id' => 'q_1', 'quoteNumber' => 'Q-001', 'status' => 'REJECTED', 'total' => '1000.00', 'currency' => 'SAR']);

    $q = LaravelWafeq::quotes()->partialUpdate('q_1', ['status' => 'REJECTED']);

    expect($q->status)->toBe('REJECTED');
});

it('destroys a quote', function () {
    $this->fakeWafeq('/quotes/q_1/', '', 204);

    expect(LaravelWafeq::quotes()->destroy('q_1'))->toBeTrue();
});

it('downloads a quote', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/quotes/q_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::quotes()->download('q_1');

    expect($response->body())->toBe('PDF');
});

it('converts a quote to an invoice', function () {
    $this->fakeWafeq('/quotes/q_1/invoice/', ['id' => 'inv_new', 'invoiceNumber' => 'INV-001', 'status' => 'DRAFT', 'total' => '1000.00', 'currency' => 'SAR']);

    $inv = LaravelWafeq::quotes()->invoice('q_1');

    expect($inv)->toBeInstanceOf(InvoiceData::class)
        ->and($inv->id)->toBe('inv_new');
});
