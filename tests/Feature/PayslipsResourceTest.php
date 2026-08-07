<?php

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists payslips', function () {
    $this->fakeWafeqPage('/payslips/', [
        ['id' => 'ps_1', 'reference' => 'PS-001', 'status' => 'APPROVED', 'total' => '5000.00', 'currency' => 'SAR', 'periodStart' => '2024-01-01', 'periodEnd' => '2024-01-31'],
    ]);

    $page = LaravelWafeq::payslips()->list();

    expect($page->results[0])->toBeInstanceOf(PayslipData::class)
        ->and($page->results[0]->status)->toBe('APPROVED');
});

it('creates a payslip', function () {
    $this->fakeWafeq('/payslips/', ['id' => 'ps_new', 'reference' => 'PS-002', 'status' => 'DRAFT', 'total' => '6000.00', 'currency' => 'SAR']);

    $ps = LaravelWafeq::payslips()->create([
        'employee' => 'e_1',
        'period_start' => '2024-01-01',
        'period_end' => '2024-01-31',
        'currency' => 'SAR',
    ]);

    expect($ps->id)->toBe('ps_new');
});

it('retrieves a payslip', function () {
    $this->fakeWafeq('/payslips/ps_1/', ['id' => 'ps_1', 'reference' => 'PS-001', 'status' => 'APPROVED', 'total' => '5000.00', 'currency' => 'SAR']);

    $ps = LaravelWafeq::payslips()->retrieve('ps_1');

    expect($ps->id)->toBe('ps_1');
});

it('updates a payslip', function () {
    $this->fakeWafeq('/payslips/ps_1/', ['id' => 'ps_1', 'reference' => 'PS-001', 'status' => 'PAID', 'total' => '5000.00', 'currency' => 'SAR']);

    $ps = LaravelWafeq::payslips()->update('ps_1', ['status' => 'PAID']);

    expect($ps->status)->toBe('PAID');
});

it('partial updates a payslip', function () {
    $this->fakeWafeq('/payslips/ps_1/', ['id' => 'ps_1', 'reference' => 'PS-001', 'status' => 'PAID', 'total' => '5000.00', 'currency' => 'SAR']);

    $ps = LaravelWafeq::payslips()->partialUpdate('ps_1', ['status' => 'PAID']);

    expect($ps->status)->toBe('PAID');
});

it('destroys a payslip', function () {
    $this->fakeWafeq('/payslips/ps_1/', '', 204);

    expect(LaravelWafeq::payslips()->destroy('ps_1'))->toBeTrue();
});

it('downloads a payslip', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/payslips/ps_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::payslips()->download('ps_1');

    expect($response->body())->toBe('PDF');
});
