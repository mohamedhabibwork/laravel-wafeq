<?php

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists bills', function () {
    $this->fakeWafeqPage('/bills/', [
        ['id' => 'b_1', 'billNumber' => 'BILL-001', 'status' => 'OPEN', 'total' => '5000.00', 'amountDue' => '5000.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15', 'dueDate' => '2024-02-15'],
    ]);

    $page = LaravelWafeq::bills()->list();

    expect($page->results[0])->toBeInstanceOf(BillData::class)
        ->and($page->results[0]->status)->toBe('OPEN')
        ->and($page->results[0]->amountDue)->toBe('5000.00');
});

it('creates a bill', function () {
    $this->fakeWafeq('/bills/', ['id' => 'b_new', 'billNumber' => 'BILL-002', 'status' => 'DRAFT', 'total' => '1000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::bills()->create([
        'vendor' => 'bn_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($bill->id)->toBe('b_new');
});

it('retrieves a bill', function () {
    $this->fakeWafeq('/bills/b_1/', ['id' => 'b_1', 'billNumber' => 'BILL-001', 'status' => 'OPEN', 'total' => '5000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::bills()->retrieve('b_1');

    expect($bill->id)->toBe('b_1');
});

it('updates a bill', function () {
    $this->fakeWafeq('/bills/b_1/', ['id' => 'b_1', 'billNumber' => 'BILL-001', 'status' => 'PAID', 'total' => '5000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::bills()->update('b_1', ['status' => 'PAID']);

    expect($bill->status)->toBe('PAID');
});

it('partial updates a bill', function () {
    $this->fakeWafeq('/bills/b_1/', ['id' => 'b_1', 'billNumber' => 'BILL-001', 'status' => 'PAID', 'total' => '5000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::bills()->partialUpdate('b_1', ['status' => 'PAID']);

    expect($bill->status)->toBe('PAID');
});

it('destroys a bill', function () {
    $this->fakeWafeq('/bills/b_1/', '', 204);

    expect(LaravelWafeq::bills()->destroy('b_1'))->toBeTrue();
});

it('downloads a bill', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/bills/b_1/download/*' => Http::response('PDF_BINARY', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::bills()->download('b_1');

    expect($response->body())->toBe('PDF_BINARY');
});
