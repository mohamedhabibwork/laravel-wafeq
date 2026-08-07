<?php

use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists debit notes line items', function () {
    $this->fakeWafeqPage('/debit-notes/line-items/', [
        ['id' => 'dnli_1', 'name' => 'Charge', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00'],
    ]);

    $page = LaravelWafeq::debitNotesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(DebitNoteLineItemData::class);
});

it('creates a debit notes line item', function () {
    $this->fakeWafeq('/debit-notes/line-items/', ['id' => 'dnli_new', 'name' => 'Service', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::debitNotesLineItems()->create([
        'debit_note' => 'dn_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '100.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('dnli_new');
});

it('retrieves a debit notes line item', function () {
    $this->fakeWafeq('/debit-notes/line-items/dnli_1/', ['id' => 'dnli_1', 'name' => 'Charge', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::debitNotesLineItems()->retrieve('dnli_1');

    expect($li->id)->toBe('dnli_1');
});

it('updates a debit notes line item', function () {
    $this->fakeWafeq('/debit-notes/line-items/dnli_1/', ['id' => 'dnli_1', 'name' => 'Updated', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::debitNotesLineItems()->update('dnli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');
});

it('partial updates a debit notes line item', function () {
    $this->fakeWafeq('/debit-notes/line-items/dnli_1/', ['id' => 'dnli_1', 'name' => 'Charge', 'quantity' => '2', 'price' => '100.00', 'total' => '200.00']);

    $li = LaravelWafeq::debitNotesLineItems()->partialUpdate('dnli_1', ['quantity' => '2']);

    expect($li->quantity)->toBe('2');
});

it('destroys a debit notes line item', function () {
    $this->fakeWafeq('/debit-notes/line-items/dnli_1/', '', 204);

    expect(LaravelWafeq::debitNotesLineItems()->destroy('dnli_1'))->toBeTrue();
});
