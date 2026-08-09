<?php

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteCreated;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteDestroyed;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteDownloaded;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteListed;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNotePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteRetrieved;
use HWafeq\LaravelWafeq\Events\CreditNotes\CreditNoteUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists credit notes', function () {
    Event::fake([CreditNoteListed::class]);
    $this->fakeWafeqPage('/credit-notes/', [
        ['id' => 'cn_1', 'creditNoteNumber' => 'CN-001', 'status' => 'OPEN', 'total' => '500.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::creditNotes()->list();

    expect($page->results[0])->toBeInstanceOf(CreditNoteData::class)
        ->and($page->results[0]->status)->toBe('OPEN');

    Event::assertDispatched(CreditNoteListed::class);
});

it('creates a credit note', function () {
    Event::fake([CreditNoteCreated::class]);
    $this->fakeWafeq('/credit-notes/', ['id' => 'cn_new', 'creditNoteNumber' => 'CN-002', 'status' => 'DRAFT', 'total' => '1000.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::creditNotes()->create([
        'contact' => 'c_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($cn->id)->toBe('cn_new');

    Event::assertDispatched(CreditNoteCreated::class);
});

it('retrieves a credit note', function () {
    Event::fake([CreditNoteRetrieved::class]);
    $this->fakeWafeq('/credit-notes/cn_1/', ['id' => 'cn_1', 'creditNoteNumber' => 'CN-001', 'status' => 'OPEN', 'total' => '500.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::creditNotes()->retrieve('cn_1');

    expect($cn->id)->toBe('cn_1');

    Event::assertDispatched(CreditNoteRetrieved::class);
});

it('updates a credit note', function () {
    Event::fake([CreditNoteUpdated::class]);
    $this->fakeWafeq('/credit-notes/cn_1/', ['id' => 'cn_1', 'creditNoteNumber' => 'CN-001', 'status' => 'APPLIED', 'total' => '500.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::creditNotes()->update('cn_1', ['status' => 'APPLIED']);

    expect($cn->status)->toBe('APPLIED');

    Event::assertDispatched(CreditNoteUpdated::class);
});

it('partial updates a credit note', function () {
    Event::fake([CreditNotePartiallyUpdated::class]);
    $this->fakeWafeq('/credit-notes/cn_1/', ['id' => 'cn_1', 'creditNoteNumber' => 'CN-001', 'status' => 'APPLIED', 'total' => '500.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::creditNotes()->partialUpdate('cn_1', ['status' => 'APPLIED']);

    expect($cn->status)->toBe('APPLIED');

    Event::assertDispatched(CreditNotePartiallyUpdated::class);
});

it('destroys a credit note', function () {
    Event::fake([CreditNoteDestroyed::class]);
    $this->fakeWafeq('/credit-notes/cn_1/', '', 204);

    expect(LaravelWafeq::creditNotes()->destroy('cn_1'))->toBeTrue();

    Event::assertDispatched(CreditNoteDestroyed::class);
});

it('downloads a credit note', function () {
    Event::fake([CreditNoteDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/credit-notes/cn_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::creditNotes()->download('cn_1');

    expect($response->body())->toBe('PDF');

    Event::assertDispatched(CreditNoteDownloaded::class);
});

it('generates a tax authority report', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/credit-notes/cn_1/tax_authority_report/*' => Http::response('{"status":"submitted"}', 200, ['Content-Type' => 'application/json']),
    ]);

    $response = LaravelWafeq::creditNotes()->taxAuthorityReport('cn_1', ['type' => 'vat']);

    expect($response->body())->toContain('submitted');
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/credit-notes/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::creditNotes()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(CreditNoteData::class)
        ->and($result->id)->toBe('m_1');
});
