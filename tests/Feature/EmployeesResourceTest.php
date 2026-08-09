<?php

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeCreated;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeDestroyed;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeListed;
use HWafeq\LaravelWafeq\Events\Employees\EmployeePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeRetrieved;
use HWafeq\LaravelWafeq\Events\Employees\EmployeeUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists employees', function () {
    Event::fake([EmployeeListed::class]);
    $this->fakeWafeqPage('/employees/', [
        ['id' => 'e_1', 'name' => 'Jane Doe', 'email' => 'jane@acme.test', 'hireDate' => '2023-01-15', 'department' => 'Engineering', 'jobTitle' => 'Senior Engineer', 'currency' => 'SAR', 'salary' => '15000.00'],
    ]);

    $page = LaravelWafeq::employees()->list();

    expect($page->results[0])->toBeInstanceOf(EmployeeData::class)
        ->and($page->results[0]->jobTitle)->toBe('Senior Engineer');

    Event::assertDispatched(EmployeeListed::class);
});

it('creates an employee', function () {
    Event::fake([EmployeeCreated::class]);
    $this->fakeWafeq('/employees/', ['id' => 'e_new', 'name' => 'John Doe', 'email' => 'john@acme.test', 'currency' => 'SAR', 'salary' => '10000.00']);

    $e = LaravelWafeq::employees()->create([
        'name' => 'John Doe',
        'email' => 'john@acme.test',
        'currency' => 'SAR',
        'salary' => '10000.00',
    ]);

    expect($e->id)->toBe('e_new');

    Event::assertDispatched(EmployeeCreated::class);
});

it('retrieves an employee', function () {
    Event::fake([EmployeeRetrieved::class]);
    $this->fakeWafeq('/employees/e_1/', ['id' => 'e_1', 'name' => 'Jane Doe', 'email' => 'jane@acme.test', 'currency' => 'SAR']);

    $e = LaravelWafeq::employees()->retrieve('e_1');

    expect($e->email)->toBe('jane@acme.test');

    Event::assertDispatched(EmployeeRetrieved::class);
});

it('updates an employee', function () {
    Event::fake([EmployeeUpdated::class]);
    $this->fakeWafeq('/employees/e_1/', ['id' => 'e_1', 'name' => 'Jane Updated', 'email' => 'jane@acme.test', 'currency' => 'SAR']);

    $e = LaravelWafeq::employees()->update('e_1', ['name' => 'Jane Updated']);

    expect($e->name)->toBe('Jane Updated');

    Event::assertDispatched(EmployeeUpdated::class);
});

it('partial updates an employee', function () {
    Event::fake([EmployeePartiallyUpdated::class]);
    $this->fakeWafeq('/employees/e_1/', ['id' => 'e_1', 'name' => 'Jane Doe', 'email' => 'jane@acme.test', 'currency' => 'SAR', 'salary' => '16000.00']);

    $e = LaravelWafeq::employees()->partialUpdate('e_1', ['salary' => '16000.00']);

    expect($e->salary)->toBe('16000.00');

    Event::assertDispatched(EmployeePartiallyUpdated::class);
});

it('destroys an employee', function () {
    Event::fake([EmployeeDestroyed::class]);
    $this->fakeWafeq('/employees/e_1/', '', 204);

    expect(LaravelWafeq::employees()->destroy('e_1'))->toBeTrue();

    Event::assertDispatched(EmployeeDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/employees/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::employees()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(EmployeeData::class)
        ->and($result->id)->toBe('m_1');
});
