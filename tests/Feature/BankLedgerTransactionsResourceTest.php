<?php

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists bank ledger transactions', function () {
    $this->fakeWafeqPage('/bank-ledger/', [
        ['id' => 'bt_1', 'date' => '2024-01-15', 'description' => 'Wire transfer', 'amount' => '10000.00', 'currency' => 'SAR', 'type' => 'CREDIT'],
    ]);

    $page = LaravelWafeq::bankLedgerTransactions()->list();

    expect($page->results[0])->toBeInstanceOf(BankLedgerTransactionData::class)
        ->and($page->results[0]->type)->toBe('CREDIT');
});

it('creates a bank ledger transaction', function () {
    $this->fakeWafeq('/bank-ledger/', ['id' => 'bt_new', 'date' => '2024-01-15', 'amount' => '500.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankLedgerTransactions()->create([
        'date' => '2024-01-15',
        'amount' => '500.00',
        'currency' => 'SAR',
        'bank_account' => 'ba_1',
    ]);

    expect($tx->id)->toBe('bt_new');
});

it('retrieves a bank ledger transaction', function () {
    $this->fakeWafeq('/bank-ledger/bt_1/', ['id' => 'bt_1', 'amount' => '1000.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankLedgerTransactions()->retrieve('bt_1');

    expect($tx->id)->toBe('bt_1');
});

it('updates a bank ledger transaction', function () {
    $this->fakeWafeq('/bank-ledger/bt_1/', ['id' => 'bt_1', 'description' => 'Updated', 'amount' => '1000.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankLedgerTransactions()->update('bt_1', ['description' => 'Updated']);

    expect($tx->description)->toBe('Updated');
});

it('partial updates a bank ledger transaction', function () {
    $this->fakeWafeq('/bank-ledger/bt_1/', ['id' => 'bt_1', 'amount' => '2000.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankLedgerTransactions()->partialUpdate('bt_1', ['amount' => '2000.00']);

    expect($tx->amount)->toBe('2000.00');
});

it('destroys a bank ledger transaction', function () {
    $this->fakeWafeq('/bank-ledger/bt_1/', '', 204);

    expect(LaravelWafeq::bankLedgerTransactions()->destroy('bt_1'))->toBeTrue();
});
