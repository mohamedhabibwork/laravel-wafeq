<?php

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists simplified invoices line items', function () {
    $this->fakeWafeqPage('/simplified-invoices/line-items/', [
        ['id' => 'sili_1', 'name' => 'Item', 'quantity' => '1', 'price' => '50.00', 'total' => '50.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::simplifiedInvoicesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(SimplifiedInvoiceLineItemData::class);
});

it('creates a simplified invoices line item', function () {
    $this->fakeWafeq('/simplified-invoices/line-items/', ['id' => 'sili_new', 'name' => 'Item', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::simplifiedInvoicesLineItems()->create([
        'simplified_invoice' => 'si_1',
        'name' => 'Item',
        'quantity' => '1',
        'price' => '100.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('sili_new');
});

it('retrieves a simplified invoices line item', function () {
    $this->fakeWafeq('/simplified-invoices/line-items/sili_1/', ['id' => 'sili_1', 'name' => 'Item', 'quantity' => '1', 'price' => '50.00', 'total' => '50.00']);

    $li = LaravelWafeq::simplifiedInvoicesLineItems()->retrieve('sili_1');

    expect($li->id)->toBe('sili_1');
});

it('updates a simplified invoices line item', function () {
    $this->fakeWafeq('/simplified-invoices/line-items/sili_1/', ['id' => 'sili_1', 'name' => 'Updated', 'quantity' => '1', 'price' => '50.00', 'total' => '50.00']);

    $li = LaravelWafeq::simplifiedInvoicesLineItems()->update('sili_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');
});

it('partial updates a simplified invoices line item', function () {
    $this->fakeWafeq('/simplified-invoices/line-items/sili_1/', ['id' => 'sili_1', 'name' => 'Item', 'quantity' => '2', 'price' => '50.00', 'total' => '100.00']);

    $li = LaravelWafeq::simplifiedInvoicesLineItems()->partialUpdate('sili_1', ['quantity' => '2']);

    expect($li->quantity)->toBe('2');
});

it('destroys a simplified invoices line item', function () {
    $this->fakeWafeq('/simplified-invoices/line-items/sili_1/', '', 204);

    expect(LaravelWafeq::simplifiedInvoicesLineItems()->destroy('sili_1'))->toBeTrue();
});
