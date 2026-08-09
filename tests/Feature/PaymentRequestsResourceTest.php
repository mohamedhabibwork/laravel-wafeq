<?php

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestCreated;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestDestroyed;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestListed;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestRetrieved;
use HWafeq\LaravelWafeq\Events\PaymentRequests\PaymentRequestUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists payment requests', function () {
    Event::fake([PaymentRequestListed::class]);
    $this->fakeWafeqPage('/payment-requests/', [
        ['id' => 'pr_1', 'reference' => 'PR-001', 'status' => 'PENDING', 'total' => '1500.00', 'currency' => 'SAR', 'date' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::paymentRequests()->list();

    expect($page->results[0])->toBeInstanceOf(PaymentRequestData::class)
        ->and($page->results[0]->status)->toBe('PENDING');

    Event::assertDispatched(PaymentRequestListed::class);
});

it('creates a payment request', function () {
    Event::fake([PaymentRequestCreated::class]);
    $this->fakeWafeq('/payment-requests/', ['id' => 'pr_new', 'reference' => 'PR-002', 'status' => 'DRAFT', 'total' => '500.00', 'currency' => 'SAR']);

    $pr = LaravelWafeq::paymentRequests()->create([
        'payee' => 'bn_1',
        'currency' => 'SAR',
        'amount' => '500.00',
    ]);

    expect($pr->id)->toBe('pr_new');

    Event::assertDispatched(PaymentRequestCreated::class);
});

it('retrieves a payment request', function () {
    Event::fake([PaymentRequestRetrieved::class]);
    $this->fakeWafeq('/payment-requests/pr_1/', ['id' => 'pr_1', 'reference' => 'PR-001', 'status' => 'PENDING', 'total' => '1500.00', 'currency' => 'SAR']);

    $pr = LaravelWafeq::paymentRequests()->retrieve('pr_1');

    expect($pr->id)->toBe('pr_1');

    Event::assertDispatched(PaymentRequestRetrieved::class);
});

it('updates a payment request', function () {
    Event::fake([PaymentRequestUpdated::class]);
    $this->fakeWafeq('/payment-requests/pr_1/', ['id' => 'pr_1', 'reference' => 'PR-001', 'status' => 'APPROVED', 'total' => '1500.00', 'currency' => 'SAR']);

    $pr = LaravelWafeq::paymentRequests()->update('pr_1', ['status' => 'APPROVED']);

    expect($pr->status)->toBe('APPROVED');

    Event::assertDispatched(PaymentRequestUpdated::class);
});

it('partial updates a payment request', function () {
    Event::fake([PaymentRequestPartiallyUpdated::class]);
    $this->fakeWafeq('/payment-requests/pr_1/', ['id' => 'pr_1', 'reference' => 'PR-001', 'status' => 'REJECTED', 'total' => '1500.00', 'currency' => 'SAR']);

    $pr = LaravelWafeq::paymentRequests()->partialUpdate('pr_1', ['status' => 'REJECTED']);

    expect($pr->status)->toBe('REJECTED');

    Event::assertDispatched(PaymentRequestPartiallyUpdated::class);
});

it('destroys a payment request', function () {
    Event::fake([PaymentRequestDestroyed::class]);
    $this->fakeWafeq('/payment-requests/pr_1/', '', 204);

    expect(LaravelWafeq::paymentRequests()->destroy('pr_1'))->toBeTrue();

    Event::assertDispatched(PaymentRequestDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/payment-requests/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::paymentRequests()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(PaymentRequestData::class)
        ->and($result->id)->toBe('m_1');
});
