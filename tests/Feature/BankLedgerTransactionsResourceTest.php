<?php

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionCreated;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionDestroyed;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionListed;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionRetrieved;
use HWafeq\LaravelWafeq\Events\BankLedgerTransactions\BankLedgerTransactionUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists bank ledger transactions', function () {
    Event::fake([BankLedgerTransactionListed::class]);
    $this->fakeWafeqPage('/bank-ledger/', [
        ['id' => 'bt_1', 'date' => '2024-01-15', 'description' => 'Wire transfer', 'amount' => '10000.00', 'currency' => 'SAR', 'type' => 'CREDIT'],
    ]);

    $page = LaravelWafeq::bankLedgerTransactions()->list();

    expect($page->results[0])->toBeInstanceOf(BankLedgerTransactionData::class)
        ->and($page->results[0]->type)->toBe('CREDIT');

    Event::assertDispatched(BankLedgerTransactionListed::class);
});

it('creates a bank ledger transaction', function () {
    Event::fake([BankLedgerTransactionCreated::class]);
    $this->fakeWafeq('/bank-ledger/', ['id' => 'bt_new', 'date' => '2024-01-15', 'amount' => '500.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankLedgerTransactions()->create([
        'date' => '2024-01-15',
        'amount' => '500.00',
        'currency' => 'SAR',
        'bank_account' => 'ba_1',
    ]);

    expect($tx->id)->toBe('bt_new');

    Event::assertDispatched(BankLedgerTransactionCreated::class);
});

it('retrieves a bank ledger transaction', function () {
    Event::fake([BankLedgerTransactionRetrieved::class]);
    $this->fakeWafeq('/bank-ledger/bt_1/', ['id' => 'bt_1', 'amount' => '1000.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankLedgerTransactions()->retrieve('bt_1');

    expect($tx->id)->toBe('bt_1');

    Event::assertDispatched(BankLedgerTransactionRetrieved::class);
});

it('updates a bank ledger transaction', function () {
    Event::fake([BankLedgerTransactionUpdated::class]);
    $this->fakeWafeq('/bank-ledger/bt_1/', ['id' => 'bt_1', 'description' => 'Updated', 'amount' => '1000.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankLedgerTransactions()->update('bt_1', ['description' => 'Updated']);

    expect($tx->description)->toBe('Updated');

    Event::assertDispatched(BankLedgerTransactionUpdated::class);
});

it('partial updates a bank ledger transaction', function () {
    Event::fake([BankLedgerTransactionPartiallyUpdated::class]);
    $this->fakeWafeq('/bank-ledger/bt_1/', ['id' => 'bt_1', 'amount' => '2000.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankLedgerTransactions()->partialUpdate('bt_1', ['amount' => '2000.00']);

    expect($tx->amount)->toBe('2000.00');

    Event::assertDispatched(BankLedgerTransactionPartiallyUpdated::class);
});

it('destroys a bank ledger transaction', function () {
    Event::fake([BankLedgerTransactionDestroyed::class]);
    $this->fakeWafeq('/bank-ledger/bt_1/', '', 204);

    expect(LaravelWafeq::bankLedgerTransactions()->destroy('bt_1'))->toBeTrue();

    Event::assertDispatched(BankLedgerTransactionDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/bank-ledger/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::bankLedgerTransactions()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(BankLedgerTransactionData::class)
        ->and($result->id)->toBe('m_1');
});
