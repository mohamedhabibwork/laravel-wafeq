<?php

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Data\QuoteData;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteCreated;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteDestroyed;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteDownloaded;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteListed;
use HWafeq\LaravelWafeq\Events\Quotes\QuotePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteRetrieved;
use HWafeq\LaravelWafeq\Events\Quotes\QuoteUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists quotes', function () {
    Event::fake([QuoteListed::class]);
    $this->fakeWafeqPage('/quotes/', [
        ['id' => 'q_1', 'quoteNumber' => 'Q-001', 'status' => 'SENT', 'total' => '1000.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15', 'expiryDate' => '2024-02-15'],
    ]);

    $page = LaravelWafeq::quotes()->list();

    expect($page->results[0])->toBeInstanceOf(QuoteData::class)
        ->and($page->results[0]->status)->toBe('SENT');

    Event::assertDispatched(QuoteListed::class);
});

it('creates a quote', function () {
    Event::fake([QuoteCreated::class]);
    $this->fakeWafeq('/quotes/', ['id' => 'q_new', 'quoteNumber' => 'Q-002', 'status' => 'DRAFT', 'total' => '500.00', 'currency' => 'SAR']);

    $q = LaravelWafeq::quotes()->create([
        'contact' => 'c_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($q->id)->toBe('q_new');

    Event::assertDispatched(QuoteCreated::class);
});

it('retrieves a quote', function () {
    Event::fake([QuoteRetrieved::class]);
    $this->fakeWafeq('/quotes/q_1/', ['id' => 'q_1', 'quoteNumber' => 'Q-001', 'status' => 'SENT', 'total' => '1000.00', 'currency' => 'SAR']);

    $q = LaravelWafeq::quotes()->retrieve('q_1');

    expect($q->id)->toBe('q_1');

    Event::assertDispatched(QuoteRetrieved::class);
});

it('updates a quote', function () {
    Event::fake([QuoteUpdated::class]);
    $this->fakeWafeq('/quotes/q_1/', ['id' => 'q_1', 'quoteNumber' => 'Q-001', 'status' => 'ACCEPTED', 'total' => '1000.00', 'currency' => 'SAR']);

    $q = LaravelWafeq::quotes()->update('q_1', ['status' => 'ACCEPTED']);

    expect($q->status)->toBe('ACCEPTED');

    Event::assertDispatched(QuoteUpdated::class);
});

it('partial updates a quote', function () {
    Event::fake([QuotePartiallyUpdated::class]);
    $this->fakeWafeq('/quotes/q_1/', ['id' => 'q_1', 'quoteNumber' => 'Q-001', 'status' => 'REJECTED', 'total' => '1000.00', 'currency' => 'SAR']);

    $q = LaravelWafeq::quotes()->partialUpdate('q_1', ['status' => 'REJECTED']);

    expect($q->status)->toBe('REJECTED');

    Event::assertDispatched(QuotePartiallyUpdated::class);
});

it('destroys a quote', function () {
    Event::fake([QuoteDestroyed::class]);
    $this->fakeWafeq('/quotes/q_1/', '', 204);

    expect(LaravelWafeq::quotes()->destroy('q_1'))->toBeTrue();

    Event::assertDispatched(QuoteDestroyed::class);
});

it('downloads a quote', function () {
    Event::fake([QuoteDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/quotes/q_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::quotes()->download('q_1');

    expect($response->body())->toBe('PDF');

    Event::assertDispatched(QuoteDownloaded::class);
});

it('converts a quote to an invoice', function () {
    $this->fakeWafeq('/quotes/q_1/invoice/', ['id' => 'inv_new', 'invoiceNumber' => 'INV-001', 'status' => 'DRAFT', 'total' => '1000.00', 'currency' => 'SAR']);

    $inv = LaravelWafeq::quotes()->invoice('q_1');

    expect($inv)->toBeInstanceOf(InvoiceData::class)
        ->and($inv->id)->toBe('inv_new');
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/quotes/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::quotes()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(QuoteData::class)
        ->and($result->id)->toBe('m_1');
});
