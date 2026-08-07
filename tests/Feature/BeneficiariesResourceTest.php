<?php

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists beneficiaries', function () {
    $this->fakeWafeqPage('/beneficiaries/', [
        ['id' => 'bn_1', 'name' => 'Acme Vendor', 'bankName' => 'SNB', 'iban' => 'SA4420000001234567890123', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::beneficiaries()->list();

    expect($page->results[0])->toBeInstanceOf(BeneficiaryData::class)
        ->and($page->results[0]->name)->toBe('Acme Vendor');
});

it('creates a beneficiary', function () {
    $this->fakeWafeq('/beneficiaries/', ['id' => 'bn_new', 'name' => 'New Vendor', 'currency' => 'SAR']);

    $b = LaravelWafeq::beneficiaries()->create(['name' => 'New Vendor', 'currency' => 'SAR']);

    expect($b->id)->toBe('bn_new');
});

it('retrieves a beneficiary', function () {
    $this->fakeWafeq('/beneficiaries/bn_1/', ['id' => 'bn_1', 'name' => 'Acme Vendor', 'currency' => 'SAR']);

    $b = LaravelWafeq::beneficiaries()->retrieve('bn_1');

    expect($b->id)->toBe('bn_1');
});

it('updates a beneficiary', function () {
    $this->fakeWafeq('/beneficiaries/bn_1/', ['id' => 'bn_1', 'name' => 'Renamed', 'currency' => 'SAR']);

    $b = LaravelWafeq::beneficiaries()->update('bn_1', ['name' => 'Renamed']);

    expect($b->name)->toBe('Renamed');
});

it('partial updates a beneficiary', function () {
    $this->fakeWafeq('/beneficiaries/bn_1/', ['id' => 'bn_1', 'name' => 'Acme Vendor', 'currency' => 'USD']);

    $b = LaravelWafeq::beneficiaries()->partialUpdate('bn_1', ['currency' => 'USD']);

    expect($b->currency)->toBe('USD');
});

it('destroys a beneficiary', function () {
    $this->fakeWafeq('/beneficiaries/bn_1/', '', 204);

    expect(LaravelWafeq::beneficiaries()->destroy('bn_1'))->toBeTrue();
});
