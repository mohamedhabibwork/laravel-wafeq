<?php

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists employees', function () {
    $this->fakeWafeqPage('/employees/', [
        ['id' => 'e_1', 'name' => 'Jane Doe', 'email' => 'jane@acme.test', 'hireDate' => '2023-01-15', 'department' => 'Engineering', 'jobTitle' => 'Senior Engineer', 'currency' => 'SAR', 'salary' => '15000.00'],
    ]);

    $page = LaravelWafeq::employees()->list();

    expect($page->results[0])->toBeInstanceOf(EmployeeData::class)
        ->and($page->results[0]->jobTitle)->toBe('Senior Engineer');
});

it('creates an employee', function () {
    $this->fakeWafeq('/employees/', ['id' => 'e_new', 'name' => 'John Doe', 'email' => 'john@acme.test', 'currency' => 'SAR', 'salary' => '10000.00']);

    $e = LaravelWafeq::employees()->create([
        'name' => 'John Doe',
        'email' => 'john@acme.test',
        'currency' => 'SAR',
        'salary' => '10000.00',
    ]);

    expect($e->id)->toBe('e_new');
});

it('retrieves an employee', function () {
    $this->fakeWafeq('/employees/e_1/', ['id' => 'e_1', 'name' => 'Jane Doe', 'email' => 'jane@acme.test', 'currency' => 'SAR']);

    $e = LaravelWafeq::employees()->retrieve('e_1');

    expect($e->email)->toBe('jane@acme.test');
});

it('updates an employee', function () {
    $this->fakeWafeq('/employees/e_1/', ['id' => 'e_1', 'name' => 'Jane Updated', 'email' => 'jane@acme.test', 'currency' => 'SAR']);

    $e = LaravelWafeq::employees()->update('e_1', ['name' => 'Jane Updated']);

    expect($e->name)->toBe('Jane Updated');
});

it('partial updates an employee', function () {
    $this->fakeWafeq('/employees/e_1/', ['id' => 'e_1', 'name' => 'Jane Doe', 'email' => 'jane@acme.test', 'currency' => 'SAR', 'salary' => '16000.00']);

    $e = LaravelWafeq::employees()->partialUpdate('e_1', ['salary' => '16000.00']);

    expect($e->salary)->toBe('16000.00');
});

it('destroys an employee', function () {
    $this->fakeWafeq('/employees/e_1/', '', 204);

    expect(LaravelWafeq::employees()->destroy('e_1'))->toBeTrue();
});
