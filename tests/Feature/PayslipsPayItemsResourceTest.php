<?php

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists payslips pay items', function () {
    $this->fakeWafeqPage('/payslips/pay-items/', [
        ['id' => 'pi_1', 'name' => 'Base salary', 'amount' => '5000.00', 'currency' => 'SAR', 'type' => 'EARNING'],
    ]);

    $page = LaravelWafeq::payslipsPayItems()->list();

    expect($page->results[0])->toBeInstanceOf(PayslipPayItemData::class)
        ->and($page->results[0]->type)->toBe('EARNING');
});

it('creates a payslips pay item', function () {
    $this->fakeWafeq('/payslips/pay-items/', ['id' => 'pi_new', 'name' => 'Bonus', 'amount' => '1000.00', 'currency' => 'SAR', 'type' => 'EARNING']);

    $pi = LaravelWafeq::payslipsPayItems()->create([
        'payslip' => 'ps_1',
        'name' => 'Bonus',
        'amount' => '1000.00',
        'currency' => 'SAR',
        'type' => 'EARNING',
    ]);

    expect($pi->id)->toBe('pi_new');
});

it('retrieves a payslips pay item', function () {
    $this->fakeWafeq('/payslips/pay-items/pi_1/', ['id' => 'pi_1', 'name' => 'Base salary', 'amount' => '5000.00', 'currency' => 'SAR', 'type' => 'EARNING']);

    $pi = LaravelWafeq::payslipsPayItems()->retrieve('pi_1');

    expect($pi->id)->toBe('pi_1');
});

it('updates a payslips pay item', function () {
    $this->fakeWafeq('/payslips/pay-items/pi_1/', ['id' => 'pi_1', 'name' => 'Updated', 'amount' => '5000.00', 'currency' => 'SAR', 'type' => 'EARNING']);

    $pi = LaravelWafeq::payslipsPayItems()->update('pi_1', ['name' => 'Updated']);

    expect($pi->name)->toBe('Updated');
});

it('partial updates a payslips pay item', function () {
    $this->fakeWafeq('/payslips/pay-items/pi_1/', ['id' => 'pi_1', 'name' => 'Base salary', 'amount' => '5500.00', 'currency' => 'SAR', 'type' => 'EARNING']);

    $pi = LaravelWafeq::payslipsPayItems()->partialUpdate('pi_1', ['amount' => '5500.00']);

    expect($pi->amount)->toBe('5500.00');
});

it('destroys a payslips pay item', function () {
    $this->fakeWafeq('/payslips/pay-items/pi_1/', '', 204);

    expect(LaravelWafeq::payslipsPayItems()->destroy('pi_1'))->toBeTrue();
});
