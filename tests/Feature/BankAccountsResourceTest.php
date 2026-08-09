<?php

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountCreated;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountDestroyed;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountListed;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountRetrieved;
use HWafeq\LaravelWafeq\Events\BankAccounts\BankAccountUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists bank accounts', function () {
    Event::fake([BankAccountListed::class]);
    $this->fakeWafeqPage('/bank-accounts/', [
        ['id' => 'ba_1', 'name' => 'AlRajhi Main', 'bankName' => 'Al Rajhi Bank', 'iban' => 'SA0380000000608010167519', 'currency' => 'SAR', 'isPaymentEnabled' => true],
    ]);

    $page = LaravelWafeq::bankAccounts()->list();

    expect($page->results[0])->toBeInstanceOf(BankAccountData::class)
        ->and($page->results[0]->iban)->toBe('SA0380000000608010167519')
        ->and($page->results[0]->isPaymentEnabled)->toBeTrue();

    Event::assertDispatched(BankAccountListed::class);
});

it('creates a bank account', function () {
    Event::fake([BankAccountCreated::class]);
    $this->fakeWafeq('/bank-accounts/', ['id' => 'ba_new', 'name' => 'AlRajhi Savings', 'bankName' => 'Al Rajhi', 'currency' => 'SAR']);

    $account = LaravelWafeq::bankAccounts()->create([
        'name' => 'AlRajhi Savings',
        'bank_name' => 'Al Rajhi',
        'currency' => 'SAR',
    ]);

    expect($account->id)->toBe('ba_new');

    Event::assertDispatched(BankAccountCreated::class);
});

it('retrieves a bank account', function () {
    Event::fake([BankAccountRetrieved::class]);
    $this->fakeWafeq('/bank-accounts/ba_1/', ['id' => 'ba_1', 'name' => 'AlRajhi Main', 'currency' => 'SAR']);

    $account = LaravelWafeq::bankAccounts()->retrieve('ba_1');

    expect($account->id)->toBe('ba_1');

    Event::assertDispatched(BankAccountRetrieved::class);
});

it('updates a bank account', function () {
    Event::fake([BankAccountUpdated::class]);
    $this->fakeWafeq('/bank-accounts/ba_1/', ['id' => 'ba_1', 'name' => 'Renamed', 'currency' => 'SAR']);

    $account = LaravelWafeq::bankAccounts()->update('ba_1', ['name' => 'Renamed']);

    expect($account->name)->toBe('Renamed');

    Event::assertDispatched(BankAccountUpdated::class);
});

it('partial updates a bank account', function () {
    Event::fake([BankAccountPartiallyUpdated::class]);
    $this->fakeWafeq('/bank-accounts/ba_1/', ['id' => 'ba_1', 'name' => 'AlRajhi Main', 'currency' => 'SAR']);

    $account = LaravelWafeq::bankAccounts()->partialUpdate('ba_1', ['currency' => 'SAR']);

    expect($account->currency)->toBe('SAR');

    Event::assertDispatched(BankAccountPartiallyUpdated::class);
});

it('destroys a bank account', function () {
    Event::fake([BankAccountDestroyed::class]);
    $this->fakeWafeq('/bank-accounts/ba_1/', '', 204);

    expect(LaravelWafeq::bankAccounts()->destroy('ba_1'))->toBeTrue();

    Event::assertDispatched(BankAccountDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/bank-accounts/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::bankAccounts()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(BankAccountData::class)
        ->and($result->id)->toBe('m_1');
});
