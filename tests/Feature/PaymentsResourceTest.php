<?php

use HWafeq\LaravelWafeq\Data\PaymentData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists payments', function () {
    $this->fakeWafeqPage('/payments/', [
        ['id' => 'pay_1', 'reference' => 'PAY-001', 'date' => '2024-01-15', 'paymentType' => 'CASH', 'amount' => '500.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::payments()->list();

    expect($page->results[0])->toBeInstanceOf(PaymentData::class)
        ->and($page->results[0]->paymentType)->toBe('CASH');
});

it('creates a payment', function () {
    $this->fakeWafeq('/payments/', ['id' => 'pay_new', 'reference' => 'PAY-002', 'date' => '2024-01-15', 'amount' => '1000.00', 'currency' => 'SAR', 'paymentType' => 'BANK_TRANSFER']);

    $pay = LaravelWafeq::payments()->create([
        'contact' => 'c_1',
        'bank_account' => 'ba_1',
        'amount' => '1000.00',
        'currency' => 'SAR',
    ]);

    expect($pay->id)->toBe('pay_new');
});

it('retrieves a payment', function () {
    $this->fakeWafeq('/payments/pay_1/', ['id' => 'pay_1', 'reference' => 'PAY-001', 'amount' => '500.00', 'currency' => 'SAR']);

    $pay = LaravelWafeq::payments()->retrieve('pay_1');

    expect($pay->id)->toBe('pay_1');
});

it('updates a payment', function () {
    $this->fakeWafeq('/payments/pay_1/', ['id' => 'pay_1', 'reference' => 'PAY-001', 'amount' => '600.00', 'currency' => 'SAR']);

    $pay = LaravelWafeq::payments()->update('pay_1', ['amount' => '600.00']);

    expect($pay->amount)->toBe('600.00');
});

it('partial updates a payment', function () {
    $this->fakeWafeq('/payments/pay_1/', ['id' => 'pay_1', 'reference' => 'PAY-001', 'amount' => '700.00', 'currency' => 'SAR']);

    $pay = LaravelWafeq::payments()->partialUpdate('pay_1', ['amount' => '700.00']);

    expect($pay->amount)->toBe('700.00');
});

it('destroys a payment', function () {
    $this->fakeWafeq('/payments/pay_1/', '', 204);

    expect(LaravelWafeq::payments()->destroy('pay_1'))->toBeTrue();
});

it('downloads a payment', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/payments/pay_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::payments()->download('pay_1');

    expect($response->body())->toBe('PDF');
});
