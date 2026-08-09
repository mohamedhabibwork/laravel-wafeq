<?php

use HWafeq\LaravelWafeq\Data\JournalLineItemData;
use HWafeq\LaravelWafeq\Events\JournalLineItems\JournalLineItemListed;
use HWafeq\LaravelWafeq\Events\JournalLineItems\JournalLineItemRetrieved;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists journal line items', function () {
    Event::fake([JournalLineItemListed::class]);
    $this->fakeWafeqPage('/journal-line-items/', [
        ['id' => 'jli_1', 'account' => 'acc_1', 'description' => 'Office rent', 'debit' => '5000.00', 'credit' => '0.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::journalLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(JournalLineItemData::class)
        ->and($page->results[0]->debit)->toBe('5000.00')
        ->and($page->results[0]->credit)->toBe('0.00');

    Event::assertDispatched(JournalLineItemListed::class);
});

it('retrieves a journal line item', function () {
    Event::fake([JournalLineItemRetrieved::class]);
    $this->fakeWafeq('/journal-line-items/jli_1/', ['id' => 'jli_1', 'account' => 'acc_1', 'description' => 'Entry', 'debit' => '100.00', 'credit' => '0.00', 'currency' => 'SAR']);

    $item = LaravelWafeq::journalLineItems()->retrieve('jli_1');

    expect($item->id)->toBe('jli_1');

    Event::assertDispatched(JournalLineItemRetrieved::class);
});
