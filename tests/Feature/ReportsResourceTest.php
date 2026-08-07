<?php

use HWafeq\LaravelWafeq\Data\ReportRowData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('returns the balance sheet as paginated data', function () {
    $this->fakeWafeqPage('/reports/balance-sheet/', [
        ['account' => 'acc_1', 'name' => 'Cash', 'total' => '10000.00', 'currency' => 'SAR'],
        ['account' => 'acc_2', 'name' => 'Bank', 'total' => '50000.00', 'currency' => 'SAR'],
    ]);

    $rows = LaravelWafeq::reports()->balanceSheet();

    expect($rows->results[0])->toBeInstanceOf(ReportRowData::class)
        ->and($rows->results[0]->account)->toBe('acc_1')
        ->and($rows->results[0]->name)->toBe('Cash')
        ->and($rows->results[0]->total)->toBe('10000.00');
});

it('returns the cash flow report', function () {
    $this->fakeWafeqPage('/reports/cash-flow/', [
        ['account' => 'acc_1', 'name' => 'Operating', 'total' => '5000.00', 'currency' => 'SAR'],
    ]);

    $rows = LaravelWafeq::reports()->cashFlow();

    expect($rows->results[0]->name)->toBe('Operating');
});

it('returns the profit and loss report', function () {
    $this->fakeWafeqPage('/reports/profit-and-loss/', [
        ['account' => 'acc_1', 'name' => 'Revenue', 'total' => '100000.00', 'currency' => 'SAR'],
    ]);

    $rows = LaravelWafeq::reports()->profitAndLoss();

    expect($rows->results[0]->name)->toBe('Revenue');
});

it('returns the trial balance report', function () {
    $this->fakeWafeqPage('/reports/trial-balance/', [
        ['account' => 'acc_1', 'name' => 'Trial', 'total' => '50000.00', 'currency' => 'SAR'],
    ]);

    $rows = LaravelWafeq::reports()->trialBalance();

    expect($rows->results[0]->name)->toBe('Trial');
});

it('forwards query parameters to all reports', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/reports/balance-sheet/*' => Http::response([
            'count' => 0, 'next' => null, 'previous' => null, 'results' => [],
        ]),
    ]);

    LaravelWafeq::reports()->balanceSheet(['from_date' => '2024-01-01', 'to_date' => '2024-12-31']);

    Http::assertSent(function ($request) {
        return $request->method() === 'GET'
            && str_contains($request->url(), '/reports/balance-sheet/')
            && $request->data() === ['from_date' => '2024-01-01', 'to_date' => '2024-12-31'];
    });
});
