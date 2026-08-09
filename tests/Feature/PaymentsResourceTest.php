<?php

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Events\Payments\PaymentCreated;
use HWafeq\LaravelWafeq\Events\Payments\PaymentDestroyed;
use HWafeq\LaravelWafeq\Events\Payments\PaymentDownloaded;
use HWafeq\LaravelWafeq\Events\Payments\PaymentListed;
use HWafeq\LaravelWafeq\Events\Payments\PaymentPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Payments\PaymentRetrieved;
use HWafeq\LaravelWafeq\Events\Payments\PaymentUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists payments', function () {
    Event::fake([PaymentListed::class]);
    $this->fakeWafeqPage('/payments/', [
        ['id' => 'pay_1', 'reference' => 'PAY-001', 'date' => '2024-01-15', 'paymentType' => 'CASH', 'amount' => '500.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::payments()->list();

    expect($page->results[0])->toBeInstanceOf(PaymentData::class)
        ->and($page->results[0]->paymentType)->toBe('CASH');

    Event::assertDispatched(PaymentListed::class);
});

it('creates a payment', function () {
    Event::fake([PaymentCreated::class]);
    $this->fakeWafeq('/payments/', ['id' => 'pay_new', 'reference' => 'PAY-002', 'date' => '2024-01-15', 'amount' => '1000.00', 'currency' => 'SAR', 'paymentType' => 'BANK_TRANSFER']);

    $pay = LaravelWafeq::payments()->create([
        'contact' => 'c_1',
        'bank_account' => 'ba_1',
        'amount' => '1000.00',
        'currency' => 'SAR',
    ]);

    expect($pay->id)->toBe('pay_new');

    Event::assertDispatched(PaymentCreated::class);
});

it('retrieves a payment', function () {
    Event::fake([PaymentRetrieved::class]);
    $this->fakeWafeq('/payments/pay_1/', ['id' => 'pay_1', 'reference' => 'PAY-001', 'amount' => '500.00', 'currency' => 'SAR']);

    $pay = LaravelWafeq::payments()->retrieve('pay_1');

    expect($pay->id)->toBe('pay_1');

    Event::assertDispatched(PaymentRetrieved::class);
});

it('updates a payment', function () {
    Event::fake([PaymentUpdated::class]);
    $this->fakeWafeq('/payments/pay_1/', ['id' => 'pay_1', 'reference' => 'PAY-001', 'amount' => '600.00', 'currency' => 'SAR']);

    $pay = LaravelWafeq::payments()->update('pay_1', ['amount' => '600.00']);

    expect($pay->amount)->toBe('600.00');

    Event::assertDispatched(PaymentUpdated::class);
});

it('partial updates a payment', function () {
    Event::fake([PaymentPartiallyUpdated::class]);
    $this->fakeWafeq('/payments/pay_1/', ['id' => 'pay_1', 'reference' => 'PAY-001', 'amount' => '700.00', 'currency' => 'SAR']);

    $pay = LaravelWafeq::payments()->partialUpdate('pay_1', ['amount' => '700.00']);

    expect($pay->amount)->toBe('700.00');

    Event::assertDispatched(PaymentPartiallyUpdated::class);
});

it('destroys a payment', function () {
    Event::fake([PaymentDestroyed::class]);
    $this->fakeWafeq('/payments/pay_1/', '', 204);

    expect(LaravelWafeq::payments()->destroy('pay_1'))->toBeTrue();

    Event::assertDispatched(PaymentDestroyed::class);
});

it('downloads a payment', function () {
    Event::fake([PaymentDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/payments/pay_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::payments()->download('pay_1');

    expect($response->body())->toBe('PDF');

    Event::assertDispatched(PaymentDownloaded::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/payments/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::payments()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(PaymentData::class)
        ->and($result->id)->toBe('m_1');
});
