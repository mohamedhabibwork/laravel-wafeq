<?php

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteCreated;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteDestroyed;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteDownloaded;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteListed;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNotePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteRetrieved;
use HWafeq\LaravelWafeq\Events\DebitNotes\DebitNoteUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists debit notes', function () {
    Event::fake([DebitNoteListed::class]);
    $this->fakeWafeqPage('/debit-notes/', [
        ['id' => 'dn_1', 'debitNoteNumber' => 'DN-001', 'status' => 'OPEN', 'total' => '250.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::debitNotes()->list();

    expect($page->results[0])->toBeInstanceOf(DebitNoteData::class)
        ->and($page->results[0]->status)->toBe('OPEN');

    Event::assertDispatched(DebitNoteListed::class);
});

it('creates a debit note', function () {
    Event::fake([DebitNoteCreated::class]);
    $this->fakeWafeq('/debit-notes/', ['id' => 'dn_new', 'debitNoteNumber' => 'DN-002', 'status' => 'DRAFT', 'total' => '500.00', 'currency' => 'SAR']);

    $dn = LaravelWafeq::debitNotes()->create(['contact' => 'c_1', 'currency' => 'SAR', 'line_items' => []]);

    expect($dn->id)->toBe('dn_new');

    Event::assertDispatched(DebitNoteCreated::class);
});

it('retrieves a debit note', function () {
    Event::fake([DebitNoteRetrieved::class]);
    $this->fakeWafeq('/debit-notes/dn_1/', ['id' => 'dn_1', 'debitNoteNumber' => 'DN-001', 'status' => 'OPEN', 'total' => '250.00', 'currency' => 'SAR']);

    $dn = LaravelWafeq::debitNotes()->retrieve('dn_1');

    expect($dn->id)->toBe('dn_1');

    Event::assertDispatched(DebitNoteRetrieved::class);
});

it('updates a debit note', function () {
    Event::fake([DebitNoteUpdated::class]);
    $this->fakeWafeq('/debit-notes/dn_1/', ['id' => 'dn_1', 'debitNoteNumber' => 'DN-001', 'status' => 'PAID', 'total' => '250.00', 'currency' => 'SAR']);

    $dn = LaravelWafeq::debitNotes()->update('dn_1', ['status' => 'PAID']);

    expect($dn->status)->toBe('PAID');

    Event::assertDispatched(DebitNoteUpdated::class);
});

it('partial updates a debit note', function () {
    Event::fake([DebitNotePartiallyUpdated::class]);
    $this->fakeWafeq('/debit-notes/dn_1/', ['id' => 'dn_1', 'debitNoteNumber' => 'DN-001', 'status' => 'PAID', 'total' => '250.00', 'currency' => 'SAR']);

    $dn = LaravelWafeq::debitNotes()->partialUpdate('dn_1', ['status' => 'PAID']);

    expect($dn->status)->toBe('PAID');

    Event::assertDispatched(DebitNotePartiallyUpdated::class);
});

it('destroys a debit note', function () {
    Event::fake([DebitNoteDestroyed::class]);
    $this->fakeWafeq('/debit-notes/dn_1/', '', 204);

    expect(LaravelWafeq::debitNotes()->destroy('dn_1'))->toBeTrue();

    Event::assertDispatched(DebitNoteDestroyed::class);
});

it('downloads a debit note', function () {
    Event::fake([DebitNoteDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/debit-notes/dn_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::debitNotes()->download('dn_1');

    expect($response->body())->toBe('PDF');

    Event::assertDispatched(DebitNoteDownloaded::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/debit-notes/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::debitNotes()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(DebitNoteData::class)
        ->and($result->id)->toBe('m_1');
});
