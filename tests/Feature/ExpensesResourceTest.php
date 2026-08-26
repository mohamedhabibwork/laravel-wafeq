<?php

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseCreated;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseDestroyed;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseListed;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseMarkedAsDraft;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseMarkedAsPosted;
use HWafeq\LaravelWafeq\Events\Expenses\ExpensePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseRetrieved;
use HWafeq\LaravelWafeq\Events\Expenses\ExpenseUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists expenses', function () {
    Event::fake([ExpenseListed::class]);
    $this->fakeWafeqPage('/expenses/', [
        ['id' => 'exp_1', 'reference' => 'EXP-001', 'status' => 'PAID', 'total' => '500.00', 'currency' => 'SAR', 'date' => '2024-01-15', 'account' => 'acc_1', 'taxAmountType' => 'TAX_INCLUSIVE'],
    ]);

    $page = LaravelWafeq::expenses()->list();

    expect($page->results[0])->toBeInstanceOf(ExpenseData::class)
        ->and($page->results[0]->taxAmountType)->toBe('TAX_INCLUSIVE');

    Event::assertDispatched(ExpenseListed::class);
});

it('creates an expense', function () {
    Event::fake([ExpenseCreated::class]);
    $this->fakeWafeq('/expenses/', ['id' => 'exp_new', 'reference' => 'EXP-002', 'status' => 'DRAFT', 'total' => '100.00', 'currency' => 'SAR', 'taxAmountType' => 'TAX_EXCLUSIVE']);

    $exp = LaravelWafeq::expenses()->create([
        'account' => 'acc_1',
        'currency' => 'SAR',
        'amount' => '100.00',
        'tax_amount_type' => 'TAX_EXCLUSIVE',
    ]);

    expect($exp->id)->toBe('exp_new')
        ->and($exp->taxAmountType)->toBe('TAX_EXCLUSIVE');

    Event::assertDispatched(ExpenseCreated::class);
});

it('retrieves an expense', function () {
    Event::fake([ExpenseRetrieved::class]);
    $this->fakeWafeq('/expenses/exp_1/', ['id' => 'exp_1', 'reference' => 'EXP-001', 'status' => 'PAID', 'total' => '500.00', 'currency' => 'SAR', 'taxAmountType' => 'TAX_INCLUSIVE']);

    $exp = LaravelWafeq::expenses()->retrieve('exp_1');

    expect($exp->id)->toBe('exp_1');

    Event::assertDispatched(ExpenseRetrieved::class);
});

it('updates an expense', function () {
    Event::fake([ExpenseUpdated::class]);
    $this->fakeWafeq('/expenses/exp_1/', ['id' => 'exp_1', 'reference' => 'EXP-001', 'status' => 'PAID', 'total' => '500.00', 'currency' => 'SAR', 'taxAmountType' => 'TAX_INCLUSIVE']);

    $exp = LaravelWafeq::expenses()->update('exp_1', ['status' => 'PAID']);

    expect($exp->status)->toBe('PAID');

    Event::assertDispatched(ExpenseUpdated::class);
});

it('partial updates an expense', function () {
    Event::fake([ExpensePartiallyUpdated::class]);
    $this->fakeWafeq('/expenses/exp_1/', ['id' => 'exp_1', 'reference' => 'EXP-001', 'status' => 'PAID', 'total' => '500.00', 'currency' => 'SAR', 'taxAmountType' => 'NO_TAX']);

    $exp = LaravelWafeq::expenses()->partialUpdate('exp_1', ['tax_amount_type' => 'NO_TAX']);

    expect($exp->taxAmountType)->toBe('NO_TAX');

    Event::assertDispatched(ExpensePartiallyUpdated::class);
});

it('destroys an expense', function () {
    Event::fake([ExpenseDestroyed::class]);
    $this->fakeWafeq('/expenses/exp_1/', '', 204);

    expect(LaravelWafeq::expenses()->destroy('exp_1'))->toBeTrue();

    Event::assertDispatched(ExpenseDestroyed::class);
});

it('marks an expense as draft', function () {
    Event::fake([ExpenseMarkedAsDraft::class]);
    $this->fakeWafeq('/expenses/exp_1/mark-as-draft/', ['id' => 'exp_1', 'status' => 'DRAFT', 'currency' => 'SAR']);

    $exp = LaravelWafeq::expenses()->markAsDraft('exp_1');

    expect($exp)->toBeInstanceOf(ExpenseData::class)
        ->and($exp->id)->toBe('exp_1')
        ->and($exp->status)->toBe('DRAFT');

    Event::assertDispatched(ExpenseMarkedAsDraft::class);
});

it('marks an expense as posted', function () {
    Event::fake([ExpenseMarkedAsPosted::class]);
    $this->fakeWafeq('/expenses/exp_1/mark-as-posted/', ['id' => 'exp_1', 'status' => 'POSTED', 'currency' => 'SAR']);

    $exp = LaravelWafeq::expenses()->markAsPosted('exp_1');

    expect($exp)->toBeInstanceOf(ExpenseData::class)
        ->and($exp->id)->toBe('exp_1')
        ->and($exp->status)->toBe('POSTED');

    Event::assertDispatched(ExpenseMarkedAsPosted::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/expenses/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::expenses()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(ExpenseData::class)
        ->and($result->id)->toBe('m_1');
});
