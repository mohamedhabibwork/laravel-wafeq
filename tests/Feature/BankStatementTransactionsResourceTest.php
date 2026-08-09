<?php

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionCreated;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionDestroyed;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionListed;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionRetrieved;
use HWafeq\LaravelWafeq\Events\BankStatementTransactions\BankStatementTransactionUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists bank statement transactions', function () {
    Event::fake([BankStatementTransactionListed::class]);
    $this->fakeWafeqPage('/bank-statement/', [
        ['id' => 'st_1', 'date' => '2024-01-15', 'amount' => '500.00', 'currency' => 'SAR', 'description' => 'POS sale'],
    ]);

    $page = LaravelWafeq::bankStatementTransactions()->list();

    expect($page->results[0])->toBeInstanceOf(BankStatementTransactionData::class)
        ->and($page->results[0]->description)->toBe('POS sale');

    Event::assertDispatched(BankStatementTransactionListed::class);
});

it('creates a bank statement transaction', function () {
    Event::fake([BankStatementTransactionCreated::class]);
    $this->fakeWafeq('/bank-statement/', ['id' => 'st_new', 'amount' => '250.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankStatementTransactions()->create([
        'amount' => '250.00',
        'currency' => 'SAR',
        'bank_account' => 'ba_1',
    ]);

    expect($tx->id)->toBe('st_new');

    Event::assertDispatched(BankStatementTransactionCreated::class);
});

it('retrieves a bank statement transaction', function () {
    Event::fake([BankStatementTransactionRetrieved::class]);
    $this->fakeWafeq('/bank-statement/st_1/', ['id' => 'st_1', 'amount' => '500.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankStatementTransactions()->retrieve('st_1');

    expect($tx->id)->toBe('st_1');

    Event::assertDispatched(BankStatementTransactionRetrieved::class);
});

it('updates a bank statement transaction', function () {
    Event::fake([BankStatementTransactionUpdated::class]);
    $this->fakeWafeq('/bank-statement/st_1/', ['id' => 'st_1', 'description' => 'Updated', 'amount' => '500.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankStatementTransactions()->update('st_1', ['description' => 'Updated']);

    expect($tx->description)->toBe('Updated');

    Event::assertDispatched(BankStatementTransactionUpdated::class);
});

it('partial updates a bank statement transaction', function () {
    Event::fake([BankStatementTransactionPartiallyUpdated::class]);
    $this->fakeWafeq('/bank-statement/st_1/', ['id' => 'st_1', 'amount' => '500.00', 'currency' => 'SAR']);

    $tx = LaravelWafeq::bankStatementTransactions()->partialUpdate('st_1', ['amount' => '500.00']);

    expect($tx->id)->toBe('st_1');

    Event::assertDispatched(BankStatementTransactionPartiallyUpdated::class);
});

it('destroys a bank statement transaction', function () {
    Event::fake([BankStatementTransactionDestroyed::class]);
    $this->fakeWafeq('/bank-statement/st_1/', '', 204);

    expect(LaravelWafeq::bankStatementTransactions()->destroy('st_1'))->toBeTrue();

    Event::assertDispatched(BankStatementTransactionDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/bank-statement/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::bankStatementTransactions()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(BankStatementTransactionData::class)
        ->and($result->id)->toBe('m_1');
});
