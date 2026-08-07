<?php

use HWafeq\LaravelWafeq\Data\PaymentRequestData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists payment requests', function () {
    $this->fakeWafeqPage('/payment-requests/', [
        ['id' => 'pr_1', 'reference' => 'PR-001', 'status' => 'PENDING', 'total' => '1500.00', 'currency' => 'SAR', 'date' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::paymentRequests()->list();

    expect($page->results[0])->toBeInstanceOf(PaymentRequestData::class)
        ->and($page->results[0]->status)->toBe('PENDING');
});

it('creates a payment request', function () {
    $this->fakeWafeq('/payment-requests/', ['id' => 'pr_new', 'reference' => 'PR-002', 'status' => 'DRAFT', 'total' => '500.00', 'currency' => 'SAR']);

    $pr = LaravelWafeq::paymentRequests()->create([
        'payee' => 'bn_1',
        'currency' => 'SAR',
        'amount' => '500.00',
    ]);

    expect($pr->id)->toBe('pr_new');
});

it('retrieves a payment request', function () {
    $this->fakeWafeq('/payment-requests/pr_1/', ['id' => 'pr_1', 'reference' => 'PR-001', 'status' => 'PENDING', 'total' => '1500.00', 'currency' => 'SAR']);

    $pr = LaravelWafeq::paymentRequests()->retrieve('pr_1');

    expect($pr->id)->toBe('pr_1');
});

it('updates a payment request', function () {
    $this->fakeWafeq('/payment-requests/pr_1/', ['id' => 'pr_1', 'reference' => 'PR-001', 'status' => 'APPROVED', 'total' => '1500.00', 'currency' => 'SAR']);

    $pr = LaravelWafeq::paymentRequests()->update('pr_1', ['status' => 'APPROVED']);

    expect($pr->status)->toBe('APPROVED');
});

it('partial updates a payment request', function () {
    $this->fakeWafeq('/payment-requests/pr_1/', ['id' => 'pr_1', 'reference' => 'PR-001', 'status' => 'REJECTED', 'total' => '1500.00', 'currency' => 'SAR']);

    $pr = LaravelWafeq::paymentRequests()->partialUpdate('pr_1', ['status' => 'REJECTED']);

    expect($pr->status)->toBe('REJECTED');
});

it('destroys a payment request', function () {
    $this->fakeWafeq('/payment-requests/pr_1/', '', 204);

    expect(LaravelWafeq::paymentRequests()->destroy('pr_1'))->toBeTrue();
});
