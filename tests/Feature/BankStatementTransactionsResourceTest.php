<?php

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists bank statement transactions', function () {
    $this->fakeWafeqPage('/bank-statement/', [
        ['id' => 'st_1', 'date' => '2024-01-15', 'amount' => '500.00', 'currency' => 'SAR', 'description' => 'POS sale'],
    ]);

    $page = LaravelWafeq::bankStatementTransactions()->list();

    expect($page->results[0])->toBeInstanceOf(BankStatementTransactionData::class)
        ->and($page->results[0]->description)->toBe('POS sale');
});

it('creates a bank statement transaction', function () {
    $this->fakeWafeq('/bank-statement/', ['id' => 'st_new', 'amount' => '250.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankStatementTransactions()->create([
        'amount' => '250.00',
        'currency' => 'SAR',
        'bank_account' => 'ba_1',
    ]);

    expect($tx->id)->toBe('st_new');
});

it('retrieves a bank statement transaction', function () {
    $this->fakeWafeq('/bank-statement/st_1/', ['id' => 'st_1', 'amount' => '500.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankStatementTransactions()->retrieve('st_1');

    expect($tx->id)->toBe('st_1');
});

it('updates a bank statement transaction', function () {
    $this->fakeWafeq('/bank-statement/st_1/', ['id' => 'st_1', 'description' => 'Updated', 'amount' => '500.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankStatementTransactions()->update('st_1', ['description' => 'Updated']);

    expect($tx->description)->toBe('Updated');
});

it('partial updates a bank statement transaction', function () {
    $this->fakeWafeq('/bank-statement/st_1/', ['id' => 'st_1', 'amount' => '500.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankStatementTransactions()->partialUpdate('st_1', ['amount' => '500.00']);

    expect($tx->id)->toBe('st_1');
});

it('destroys a bank statement transaction', function () {
    $this->fakeWafeq('/bank-statement/st_1/', '', 204);

    expect(LaravelWafeq::bankStatementTransactions()->destroy('st_1'))->toBeTrue();
});
