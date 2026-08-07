<?php

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists expenses', function () {
    $this->fakeWafeqPage('/expenses/', [
        ['id' => 'exp_1', 'reference' => 'EXP-001', 'status' => 'PAID', 'total' => '500.00', 'currency' => 'SAR', 'date' => '2024-01-15', 'account' => 'acc_1', 'taxAmountType' => 'TAX_INCLUSIVE'],
    ]);

    $page = LaravelWafeq::expenses()->list();

    expect($page->results[0])->toBeInstanceOf(ExpenseData::class)
        ->and($page->results[0]->taxAmountType)->toBe('TAX_INCLUSIVE');
});

it('creates an expense', function () {
    $this->fakeWafeq('/expenses/', ['id' => 'exp_new', 'reference' => 'EXP-002', 'status' => 'DRAFT', 'total' => '100.00', 'currency' => 'SAR', 'taxAmountType' => 'TAX_EXCLUSIVE']);

    $exp = LaravelWafeq::expenses()->create([
        'account' => 'acc_1',
        'currency' => 'SAR',
        'amount' => '100.00',
        'tax_amount_type' => 'TAX_EXCLUSIVE',
    ]);

    expect($exp->id)->toBe('exp_new')
        ->and($exp->taxAmountType)->toBe('TAX_EXCLUSIVE');
});

it('retrieves an expense', function () {
    $this->fakeWafeq('/expenses/exp_1/', ['id' => 'exp_1', 'reference' => 'EXP-001', 'status' => 'PAID', 'total' => '500.00', 'currency' => 'SAR', 'taxAmountType' => 'TAX_INCLUSIVE']);

    $exp = LaravelWafeq::expenses()->retrieve('exp_1');

    expect($exp->id)->toBe('exp_1');
});

it('updates an expense', function () {
    $this->fakeWafeq('/expenses/exp_1/', ['id' => 'exp_1', 'reference' => 'EXP-001', 'status' => 'PAID', 'total' => '500.00', 'currency' => 'SAR', 'taxAmountType' => 'TAX_INCLUSIVE']);

    $exp = LaravelWafeq::expenses()->update('exp_1', ['status' => 'PAID']);

    expect($exp->status)->toBe('PAID');
});

it('partial updates an expense', function () {
    $this->fakeWafeq('/expenses/exp_1/', ['id' => 'exp_1', 'reference' => 'EXP-001', 'status' => 'PAID', 'total' => '500.00', 'currency' => 'SAR', 'taxAmountType' => 'NO_TAX']);

    $exp = LaravelWafeq::expenses()->partialUpdate('exp_1', ['tax_amount_type' => 'NO_TAX']);

    expect($exp->taxAmountType)->toBe('NO_TAX');
});

it('destroys an expense', function () {
    $this->fakeWafeq('/expenses/exp_1/', '', 204);

    expect(LaravelWafeq::expenses()->destroy('exp_1'))->toBeTrue();
});
