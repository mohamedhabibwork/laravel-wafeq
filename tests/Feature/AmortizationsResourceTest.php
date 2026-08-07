<?php

use HWafeq\LaravelWafeq\Data\AmortizationData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Exceptions\NotFoundException;
use HWafeq\LaravelWafeq\Exceptions\ValidationException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists amortizations', function () {
    $this->fakeWafeqPage('/amortizations/', [
        ['id' => 'am_1', 'name' => 'Annual Insurance', 'status' => 'ACTIVE', 'totalAmount' => '12000.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::amortizations()->list();

    expect($page)->toBeInstanceOf(PaginatedData::class)
        ->and($page->results[0])->toBeInstanceOf(AmortizationData::class)
        ->and($page->results[0]->name)->toBe('Annual Insurance');
});

it('retrieves an amortization', function () {
    $this->fakeWafeq('/amortizations/am_1/', [
        'id' => 'am_1',
        'name' => 'Annual Insurance',
        'status' => 'ACTIVE',
        'totalAmount' => '12000.00',
        'currency' => 'SAR',
        'startDate' => '2024-01-01',
        'endDate' => '2024-12-31',
    ]);

    $amort = LaravelWafeq::amortizations()->retrieve('am_1');

    expect($amort->id)->toBe('am_1')
        ->and($amort->startDate)->toBe('2024-01-01')
        ->and($amort->endDate)->toBe('2024-12-31');
});

it('destroys an amortization', function () {
    $this->fakeWafeq('/amortizations/am_1/', '', 204);

    expect(LaravelWafeq::amortizations()->destroy('am_1'))->toBeTrue();
});

it('previews an amortization before creating', function () {
    $this->fakeWafeq('/amortizations/preview/', [
        'id' => 'preview_1',
        'name' => 'Pre-annual Insurance',
        'totalAmount' => '12000.00',
        'currency' => 'SAR',
    ]);

    $preview = LaravelWafeq::amortizations()->previewCreate([
        'name' => 'Annual Insurance',
        'total' => '12000.00',
        'currency' => 'SAR',
    ]);

    expect($preview->id)->toBe('preview_1')
        ->and($preview->totalAmount)->toBe('12000.00');
});

it('ends an amortization early', function () {
    $this->fakeWafeq('/amortizations/am_1/end_early/', [
        'id' => 'am_1',
        'name' => 'Annual Insurance',
        'status' => 'ENDED_EARLY',
    ]);

    $result = LaravelWafeq::amortizations()->endEarly('am_1', ['effective_date' => '2024-06-30']);

    expect($result->status)->toBe('ENDED_EARLY');
});

it('previews ending an amortization early', function () {
    $this->fakeWafeq('/amortizations/am_1/preview_end_early/', [
        'id' => 'am_1',
        'name' => 'Annual Insurance',
        'status' => 'PREVIEW_ENDED',
    ]);

    $preview = LaravelWafeq::amortizations()->previewEndEarly('am_1', ['effective_date' => '2024-06-30']);

    expect($preview->status)->toBe('PREVIEW_ENDED');
});

it('throws NotFoundException on retrieve', function () {
    $this->fakeNotFound('/amortizations/am_missing/');

    LaravelWafeq::amortizations()->retrieve('am_missing');
})->throws(NotFoundException::class);

it('throws ValidationException on previewCreate', function () {
    $this->fakeValidationError('/amortizations/preview/', ['name' => ['Required.']]);

    LaravelWafeq::amortizations()->previewCreate(['name' => '']);
})->throws(ValidationException::class);
