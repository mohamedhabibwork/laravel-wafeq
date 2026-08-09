<?php

use HWafeq\LaravelWafeq\Data\PayslipPayItemData;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemCreated;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemDestroyed;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemListed;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemRetrieved;
use HWafeq\LaravelWafeq\Events\PayslipsPayItems\PayslipPayItemUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists payslips pay items', function () {
    Event::fake([PayslipPayItemListed::class]);
    $this->fakeWafeqPage('/payslips/pay-items/', [
        ['id' => 'pi_1', 'name' => 'Base salary', 'amount' => '5000.00', 'currency' => 'SAR', 'type' => 'EARNING'],
    ]);

    $page = LaravelWafeq::payslipsPayItems()->list();

    expect($page->results[0])->toBeInstanceOf(PayslipPayItemData::class)
        ->and($page->results[0]->type)->toBe('EARNING');

    Event::assertDispatched(PayslipPayItemListed::class);
});

it('creates a payslips pay item', function () {
    Event::fake([PayslipPayItemCreated::class]);
    $this->fakeWafeq('/payslips/pay-items/', ['id' => 'pi_new', 'name' => 'Bonus', 'amount' => '1000.00', 'currency' => 'SAR', 'type' => 'EARNING']);

    $pi = LaravelWafeq::payslipsPayItems()->create([
        'payslip' => 'ps_1',
        'name' => 'Bonus',
        'amount' => '1000.00',
        'currency' => 'SAR',
        'type' => 'EARNING',
    ]);

    expect($pi->id)->toBe('pi_new');

    Event::assertDispatched(PayslipPayItemCreated::class);
});

it('retrieves a payslips pay item', function () {
    Event::fake([PayslipPayItemRetrieved::class]);
    $this->fakeWafeq('/payslips/pay-items/pi_1/', ['id' => 'pi_1', 'name' => 'Base salary', 'amount' => '5000.00', 'currency' => 'SAR', 'type' => 'EARNING']);

    $pi = LaravelWafeq::payslipsPayItems()->retrieve('pi_1');

    expect($pi->id)->toBe('pi_1');

    Event::assertDispatched(PayslipPayItemRetrieved::class);
});

it('updates a payslips pay item', function () {
    Event::fake([PayslipPayItemUpdated::class]);
    $this->fakeWafeq('/payslips/pay-items/pi_1/', ['id' => 'pi_1', 'name' => 'Updated', 'amount' => '5000.00', 'currency' => 'SAR', 'type' => 'EARNING']);

    $pi = LaravelWafeq::payslipsPayItems()->update('pi_1', ['name' => 'Updated']);

    expect($pi->name)->toBe('Updated');

    Event::assertDispatched(PayslipPayItemUpdated::class);
});

it('partial updates a payslips pay item', function () {
    Event::fake([PayslipPayItemPartiallyUpdated::class]);
    $this->fakeWafeq('/payslips/pay-items/pi_1/', ['id' => 'pi_1', 'name' => 'Base salary', 'amount' => '5500.00', 'currency' => 'SAR', 'type' => 'EARNING']);

    $pi = LaravelWafeq::payslipsPayItems()->partialUpdate('pi_1', ['amount' => '5500.00']);

    expect($pi->amount)->toBe('5500.00');

    Event::assertDispatched(PayslipPayItemPartiallyUpdated::class);
});

it('destroys a payslips pay item', function () {
    Event::fake([PayslipPayItemDestroyed::class]);
    $this->fakeWafeq('/payslips/pay-items/pi_1/', '', 204);

    expect(LaravelWafeq::payslipsPayItems()->destroy('pi_1'))->toBeTrue();

    Event::assertDispatched(PayslipPayItemDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/payslips/pay-items/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::payslipsPayItems()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(PayslipPayItemData::class)
        ->and($result->id)->toBe('m_1');
});
