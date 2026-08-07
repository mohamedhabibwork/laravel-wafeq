<?php

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists invoices line items', function () {
    $this->fakeWafeqPage('/invoices/line-items/', [
        ['id' => 'ili_1', 'name' => 'Service', 'quantity' => '2', 'price' => '500.00', 'total' => '1000.00', 'account' => 'acc_1', 'taxRate' => 'tx_1'],
    ]);

    $page = LaravelWafeq::invoicesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(InvoiceLineItemData::class)
        ->and($page->results[0]->taxRate)->toBe('tx_1');
});

it('creates an invoices line item', function () {
    $this->fakeWafeq('/invoices/line-items/', ['id' => 'ili_new', 'name' => 'Service', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::invoicesLineItems()->create([
        'invoice' => 'inv_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '500.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('ili_new');
});

it('retrieves an invoices line item', function () {
    $this->fakeWafeq('/invoices/line-items/ili_1/', ['id' => 'ili_1', 'name' => 'Service', 'quantity' => '2', 'price' => '500.00', 'total' => '1000.00']);

    $li = LaravelWafeq::invoicesLineItems()->retrieve('ili_1');

    expect($li->id)->toBe('ili_1');
});

it('updates an invoices line item', function () {
    $this->fakeWafeq('/invoices/line-items/ili_1/', ['id' => 'ili_1', 'name' => 'Updated', 'quantity' => '2', 'price' => '500.00', 'total' => '1000.00']);

    $li = LaravelWafeq::invoicesLineItems()->update('ili_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');
});

it('partial updates an invoices line item', function () {
    $this->fakeWafeq('/invoices/line-items/ili_1/', ['id' => 'ili_1', 'name' => 'Service', 'quantity' => '3', 'price' => '500.00', 'total' => '1500.00']);

    $li = LaravelWafeq::invoicesLineItems()->partialUpdate('ili_1', ['quantity' => '3']);

    expect($li->quantity)->toBe('3');
});

it('destroys an invoices line item', function () {
    $this->fakeWafeq('/invoices/line-items/ili_1/', '', 204);

    expect(LaravelWafeq::invoicesLineItems()->destroy('ili_1'))->toBeTrue();
});
