<?php

use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Events\Bills\BillCreated;
use HWafeq\LaravelWafeq\Events\Bills\BillDestroyed;
use HWafeq\LaravelWafeq\Events\Bills\BillDownloaded;
use HWafeq\LaravelWafeq\Events\Bills\BillListed;
use HWafeq\LaravelWafeq\Events\Bills\BillPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Bills\BillRetrieved;
use HWafeq\LaravelWafeq\Events\Bills\BillUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists bills', function () {
    Event::fake([BillListed::class]);
    $this->fakeWafeqPage('/bills/', [
        ['id' => 'b_1', 'billNumber' => 'BILL-001', 'status' => 'OPEN', 'total' => '5000.00', 'amountDue' => '5000.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15', 'dueDate' => '2024-02-15'],
    ]);

    $page = LaravelWafeq::bills()->list();

    expect($page->results[0])->toBeInstanceOf(BillData::class)
        ->and($page->results[0]->status)->toBe('OPEN')
        ->and($page->results[0]->amountDue)->toBe('5000.00');

    Event::assertDispatched(BillListed::class);
});

it('creates a bill', function () {
    Event::fake([BillCreated::class]);
    $this->fakeWafeq('/bills/', ['id' => 'b_new', 'billNumber' => 'BILL-002', 'status' => 'DRAFT', 'total' => '1000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::bills()->create([
        'vendor' => 'bn_1',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($bill->id)->toBe('b_new');

    Event::assertDispatched(BillCreated::class);
});

it('retrieves a bill', function () {
    Event::fake([BillRetrieved::class]);
    $this->fakeWafeq('/bills/b_1/', ['id' => 'b_1', 'billNumber' => 'BILL-001', 'status' => 'OPEN', 'total' => '5000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::bills()->retrieve('b_1');

    expect($bill->id)->toBe('b_1');

    Event::assertDispatched(BillRetrieved::class);
});

it('updates a bill', function () {
    Event::fake([BillUpdated::class]);
    $this->fakeWafeq('/bills/b_1/', ['id' => 'b_1', 'billNumber' => 'BILL-001', 'status' => 'PAID', 'total' => '5000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::bills()->update('b_1', ['status' => 'PAID']);

    expect($bill->status)->toBe('PAID');

    Event::assertDispatched(BillUpdated::class);
});

it('partial updates a bill', function () {
    Event::fake([BillPartiallyUpdated::class]);
    $this->fakeWafeq('/bills/b_1/', ['id' => 'b_1', 'billNumber' => 'BILL-001', 'status' => 'PAID', 'total' => '5000.00', 'currency' => 'SAR']);

    $bill = LaravelWafeq::bills()->partialUpdate('b_1', ['status' => 'PAID']);

    expect($bill->status)->toBe('PAID');

    Event::assertDispatched(BillPartiallyUpdated::class);
});

it('destroys a bill', function () {
    Event::fake([BillDestroyed::class]);
    $this->fakeWafeq('/bills/b_1/', '', 204);

    expect(LaravelWafeq::bills()->destroy('b_1'))->toBeTrue();

    Event::assertDispatched(BillDestroyed::class);
});

it('downloads a bill', function () {
    Event::fake([BillDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/bills/b_1/download/*' => Http::response('PDF_BINARY', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::bills()->download('b_1');

    expect($response->body())->toBe('PDF_BINARY');

    Event::assertDispatched(BillDownloaded::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/bills/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::bills()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(BillData::class)
        ->and($result->id)->toBe('m_1');
});
