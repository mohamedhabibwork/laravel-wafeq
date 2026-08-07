<?php

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists credit notes line items', function () {
    $this->fakeWafeqPage('/credit-notes/line-items/', [
        ['id' => 'cnli_1', 'name' => 'Refund', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::creditNotesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(CreditNoteLineItemData::class);
});

it('creates a credit notes line item', function () {
    $this->fakeWafeq('/credit-notes/line-items/', ['id' => 'cnli_new', 'name' => 'Service', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::creditNotesLineItems()->create([
        'credit_note' => 'cn_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '100.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('cnli_new');
});

it('retrieves a credit notes line item', function () {
    $this->fakeWafeq('/credit-notes/line-items/cnli_1/', ['id' => 'cnli_1', 'name' => 'Refund', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::creditNotesLineItems()->retrieve('cnli_1');

    expect($li->id)->toBe('cnli_1');
});

it('updates a credit notes line item', function () {
    $this->fakeWafeq('/credit-notes/line-items/cnli_1/', ['id' => 'cnli_1', 'name' => 'Updated', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::creditNotesLineItems()->update('cnli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');
});

it('partial updates a credit notes line item', function () {
    $this->fakeWafeq('/credit-notes/line-items/cnli_1/', ['id' => 'cnli_1', 'name' => 'Refund', 'quantity' => '2', 'price' => '500.00', 'total' => '1000.00']);

    $li = LaravelWafeq::creditNotesLineItems()->partialUpdate('cnli_1', ['quantity' => '2']);

    expect($li->quantity)->toBe('2');
});

it('destroys a credit notes line item', function () {
    $this->fakeWafeq('/credit-notes/line-items/cnli_1/', '', 204);

    expect(LaravelWafeq::creditNotesLineItems()->destroy('cnli_1'))->toBeTrue();
});
