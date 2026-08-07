<?php

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists bank accounts', function () {
    $this->fakeWafeqPage('/bank-accounts/', [
        ['id' => 'ba_1', 'name' => 'AlRajhi Main', 'bankName' => 'Al Rajhi Bank', 'iban' => 'SA0380000000608010167519', 'currency' => 'SAR', 'isPaymentEnabled' => true],
    ]);

    $page = LaravelWafeq::bankAccounts()->list();

    expect($page->results[0])->toBeInstanceOf(BankAccountData::class)
        ->and($page->results[0]->iban)->toBe('SA0380000000608010167519')
        ->and($page->results[0]->isPaymentEnabled)->toBeTrue();
});

it('creates a bank account', function () {
    $this->fakeWafeq('/bank-accounts/', ['id' => 'ba_new', 'name' => 'AlRajhi Savings', 'bankName' => 'Al Rajhi', 'currency' => 'SAR']);

    $account = LaravelWafeq::bankAccounts()->create([
        'name' => 'AlRajhi Savings',
        'bank_name' => 'Al Rajhi',
        'currency' => 'SAR',
    ]);

    expect($account->id)->toBe('ba_new');
});

it('retrieves a bank account', function () {
    $this->fakeWafeq('/bank-accounts/ba_1/', ['id' => 'ba_1', 'name' => 'AlRajhi Main', 'currency' => 'SAR']);

    $account = LaravelWafeq::bankAccounts()->retrieve('ba_1');

    expect($account->id)->toBe('ba_1');
});

it('updates a bank account', function () {
    $this->fakeWafeq('/bank-accounts/ba_1/', ['id' => 'ba_1', 'name' => 'Renamed', 'currency' => 'SAR']);

    $account = LaravelWafeq::bankAccounts()->update('ba_1', ['name' => 'Renamed']);

    expect($account->name)->toBe('Renamed');
});

it('partial updates a bank account', function () {
    $this->fakeWafeq('/bank-accounts/ba_1/', ['id' => 'ba_1', 'name' => 'AlRajhi Main', 'currency' => 'SAR']);

    $account = LaravelWafeq::bankAccounts()->partialUpdate('ba_1', ['currency' => 'SAR']);

    expect($account->currency)->toBe('SAR');
});

it('destroys a bank account', function () {
    $this->fakeWafeq('/bank-accounts/ba_1/', '', 204);

    expect(LaravelWafeq::bankAccounts()->destroy('ba_1'))->toBeTrue();
});
