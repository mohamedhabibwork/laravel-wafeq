<?php

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteDestroyed;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteDownloaded;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteListed;
use HWafeq\LaravelWafeq\Events\ApiCreditNotes\ApiCreditNoteRetrieved;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists api credit notes', function () {
    Event::fake([ApiCreditNoteListed::class]);
    $this->fakeWafeqPage('/api-credit-notes/', [
        ['id' => 'acn_1', 'reference' => 'CN-001', 'status' => 'SENT', 'total' => '500.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::apiCreditNotes()->list();

    expect($page->results[0])->toBeInstanceOf(ApiCreditNoteData::class)
        ->and($page->results[0]->reference)->toBe('CN-001');

    Event::assertDispatched(ApiCreditNoteListed::class);
});

it('retrieves an api credit note', function () {
    Event::fake([ApiCreditNoteRetrieved::class]);
    $this->fakeWafeq('/api-credit-notes/acn_1/', ['id' => 'acn_1', 'reference' => 'CN-001', 'status' => 'SENT', 'total' => '500.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::apiCreditNotes()->retrieve('acn_1');

    expect($cn->id)->toBe('acn_1');

    Event::assertDispatched(ApiCreditNoteRetrieved::class);
});

it('destroys an api credit note', function () {
    Event::fake([ApiCreditNoteDestroyed::class]);
    $this->fakeWafeq('/api-credit-notes/acn_1/', '', 204);

    expect(LaravelWafeq::apiCreditNotes()->destroy('acn_1'))->toBeTrue();

    Event::assertDispatched(ApiCreditNoteDestroyed::class);
});

it('downloads an api credit note', function () {
    Event::fake([ApiCreditNoteDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/api-credit-notes/acn_1/download/*' => Http::response('PDF_BINARY', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::apiCreditNotes()->download('acn_1');

    expect($response->body())->toBe('PDF_BINARY');

    Event::assertDispatched(ApiCreditNoteDownloaded::class);
});

it('bulk sends api credit notes', function () {
    $this->fakeWafeq('/api-credit-notes/bulk_send/', ['queued' => 1]);

    $result = LaravelWafeq::apiCreditNotes()->bulkSend([['reference' => 'CN-001']]);

    expect($result)->toBe(['queued' => 1]);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/api-credit-notes/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::apiCreditNotes()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(ApiCreditNoteData::class)
        ->and($result->id)->toBe('m_1');
});
