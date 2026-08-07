<?php

use HWafeq\LaravelWafeq\Data\JournalLineItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists journal line items', function () {
    $this->fakeWafeqPage('/journal-line-items/', [
        ['id' => 'jli_1', 'account' => 'acc_1', 'description' => 'Office rent', 'debit' => '5000.00', 'credit' => '0.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::journalLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(JournalLineItemData::class)
        ->and($page->results[0]->debit)->toBe('5000.00')
        ->and($page->results[0]->credit)->toBe('0.00');
});

it('retrieves a journal line item', function () {
    $this->fakeWafeq('/journal-line-items/jli_1/', ['id' => 'jli_1', 'account' => 'acc_1', 'description' => 'Entry', 'debit' => '100.00', 'credit' => '0.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::journalLineItems()->retrieve('jli_1');

    expect($item->id)->toBe('jli_1');
});
