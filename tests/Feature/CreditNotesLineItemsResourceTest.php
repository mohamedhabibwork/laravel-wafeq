<?php

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemCreated;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemDestroyed;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemListed;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemRetrieved;
use HWafeq\LaravelWafeq\Events\CreditNotesLineItems\CreditNoteLineItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists credit notes line items', function () {
    Event::fake([CreditNoteLineItemListed::class]);
    $this->fakeWafeqPage('/credit-notes/line-items/', [
        ['id' => 'cnli_1', 'name' => 'Refund', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::creditNotesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(CreditNoteLineItemData::class);

    Event::assertDispatched(CreditNoteLineItemListed::class);
});

it('creates a credit notes line item', function () {
    Event::fake([CreditNoteLineItemCreated::class]);
    $this->fakeWafeq('/credit-notes/line-items/', ['id' => 'cnli_new', 'name' => 'Service', 'quantity' => '1', 'price' => '100.00', 'total' => '100.00']);

    $li = LaravelWafeq::creditNotesLineItems()->create([
        'credit_note' => 'cn_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '100.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('cnli_new');

    Event::assertDispatched(CreditNoteLineItemCreated::class);
});

it('retrieves a credit notes line item', function () {
    Event::fake([CreditNoteLineItemRetrieved::class]);
    $this->fakeWafeq('/credit-notes/line-items/cnli_1/', ['id' => 'cnli_1', 'name' => 'Refund', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::creditNotesLineItems()->retrieve('cnli_1');

    expect($li->id)->toBe('cnli_1');

    Event::assertDispatched(CreditNoteLineItemRetrieved::class);
});

it('updates a credit notes line item', function () {
    Event::fake([CreditNoteLineItemUpdated::class]);
    $this->fakeWafeq('/credit-notes/line-items/cnli_1/', ['id' => 'cnli_1', 'name' => 'Updated', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::creditNotesLineItems()->update('cnli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');

    Event::assertDispatched(CreditNoteLineItemUpdated::class);
});

it('partial updates a credit notes line item', function () {
    Event::fake([CreditNoteLineItemPartiallyUpdated::class]);
    $this->fakeWafeq('/credit-notes/line-items/cnli_1/', ['id' => 'cnli_1', 'name' => 'Refund', 'quantity' => '2', 'price' => '500.00', 'total' => '1000.00']);

    $li = LaravelWafeq::creditNotesLineItems()->partialUpdate('cnli_1', ['quantity' => '2']);

    expect($li->quantity)->toBe('2');

    Event::assertDispatched(CreditNoteLineItemPartiallyUpdated::class);
});

it('destroys a credit notes line item', function () {
    Event::fake([CreditNoteLineItemDestroyed::class]);
    $this->fakeWafeq('/credit-notes/line-items/cnli_1/', '', 204);

    expect(LaravelWafeq::creditNotesLineItems()->destroy('cnli_1'))->toBeTrue();

    Event::assertDispatched(CreditNoteLineItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/credit-notes/line-items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::creditNotesLineItems()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(CreditNoteLineItemData::class)
        ->and($result->id)->toBe('m_1');
});
