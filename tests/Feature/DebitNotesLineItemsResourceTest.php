<?php

use HWafeq\LaravelWafeq\Data\DebitNoteLineItemData;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemCreated;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemListed;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\DebitNotesLineItems\DebitNoteLineItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists debit notes line items', function () {
    Event::fake([DebitNoteLineItemListed::class]);
    $this->fakeWafeqPage('/debit-notes/line-items/', [
        ['id' => 'dnli_1', 'name' => 'Charge', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00'],
    ]);

    $page = LaravelWafeq::debitNotesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(DebitNoteLineItemData::class);

    Event::assertDispatched(DebitNoteLineItemListed::class);
});

it('creates a debit notes line item', function () {
    Event::fake([DebitNoteLineItemCreated::class]);
    $this->fakeWafeq('/debit-notes/line-items/', ['id' => 'dnli_new', 'name' => 'Service', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::debitNotesLineItems()->create([
        'debit_note' => 'dn_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '100.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('dnli_new');

    Event::assertDispatched(DebitNoteLineItemCreated::class);
});

it('retrieves a debit notes line item', function () {
    Event::fake([DebitNoteLineItemRetrieved::class]);
    $this->fakeWafeq('/debit-notes/line-items/dnli_1/', ['id' => 'dnli_1', 'name' => 'Charge', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::debitNotesLineItems()->retrieve('dnli_1');

    expect($li->id)->toBe('dnli_1');

    Event::assertDispatched(DebitNoteLineItemRetrieved::class);
});

it('updates a debit notes line item', function () {
    Event::fake([DebitNoteLineItemUpdated::class]);
    $this->fakeWafeq('/debit-notes/line-items/dnli_1/', ['id' => 'dnli_1', 'name' => 'Updated', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::debitNotesLineItems()->update('dnli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');

    Event::assertDispatched(DebitNoteLineItemUpdated::class);
});

it('partial updates a debit notes line item', function () {
    Event::fake([DebitNoteLineItemPartiallyUpdated::class]);
    $this->fakeWafeq('/debit-notes/line-items/dnli_1/', ['id' => 'dnli_1', 'name' => 'Charge', 'quantity' => '2', 'price' => '100.00', 'total' => '200.00']);

    $li = LaravelWafeq::debitNotesLineItems()->partialUpdate('dnli_1', ['quantity' => '2']);

    expect($li->quantity)->toBe('2');

    Event::assertDispatched(DebitNoteLineItemPartiallyUpdated::class);
});

it('destroys a debit notes line item', function () {
    Event::fake([DebitNoteLineItemDestroyed::class]);
    $this->fakeWafeq('/debit-notes/line-items/dnli_1/', '', 204);

    expect(LaravelWafeq::debitNotesLineItems()->destroy('dnli_1'))->toBeTrue();

    Event::assertDispatched(DebitNoteLineItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/debit-notes/line-items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::debitNotesLineItems()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(DebitNoteLineItemData::class)
        ->and($result->id)->toBe('m_1');
});
