<?php

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists revenue recognitions', function () {
    $this->fakeWafeqPage('/revenue-recognitions/', [
        ['id' => 'rr_1', 'name' => 'Annual License', 'status' => 'ACTIVE', 'totalAmount' => '12000.00', 'recognizedAmount' => '3000.00', 'currency' => 'SAR', 'startDate' => '2024-01-01', 'endDate' => '2024-12-31'],
    ]);

    $page = LaravelWafeq::revenueRecognitions()->list();

    expect($page->results[0])->toBeInstanceOf(RevenueRecognitionData::class)
        ->and($page->results[0]->status)->toBe('ACTIVE');
});

it('retrieves a revenue recognition', function () {
    $this->fakeWafeq('/revenue-recognitions/rr_1/', ['id' => 'rr_1', 'name' => 'Annual License', 'status' => 'ACTIVE', 'totalAmount' => '12000.00', 'currency' => 'SAR']);

    $rr = LaravelWafeq::revenueRecognitions()->retrieve('rr_1');

    expect($rr->id)->toBe('rr_1');
});

it('destroys a revenue recognition', function () {
    $this->fakeWafeq('/revenue-recognitions/rr_1/', '', 204);

    expect(LaravelWafeq::revenueRecognitions()->destroy('rr_1'))->toBeTrue();
});

it('previews a revenue recognition before creating', function () {
    $this->fakeWafeq('/revenue-recognitions/preview/', ['id' => 'preview_1', 'name' => 'Preview', 'totalAmount' => '12000.00', 'currency' => 'SAR']);

    $preview = LaravelWafeq::revenueRecognitions()->previewCreate([
        'name' => 'Annual License',
        'total' => '12000.00',
        'currency' => 'SAR',
    ]);

    expect($preview->id)->toBe('preview_1');
});

it('ends a revenue recognition early', function () {
    $this->fakeWafeq('/revenue-recognitions/rr_1/end_early/', ['id' => 'rr_1', 'name' => 'Annual License', 'status' => 'ENDED_EARLY']);

    $rr = LaravelWafeq::revenueRecognitions()->endEarly('rr_1', ['effective_date' => '2024-06-30']);

    expect($rr->status)->toBe('ENDED_EARLY');
});

it('previews ending a revenue recognition early', function () {
    $this->fakeWafeq('/revenue-recognitions/rr_1/preview_end_early/', ['id' => 'rr_1', 'name' => 'Annual License', 'status' => 'PREVIEW_ENDED']);

    $preview = LaravelWafeq::revenueRecognitions()->previewEndEarly('rr_1', ['effective_date' => '2024-06-30']);

    expect($preview->status)->toBe('PREVIEW_ENDED');
});
