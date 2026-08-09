<?php

use HWafeq\LaravelWafeq\Data\PayslipData;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipCreated;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipDestroyed;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipDownloaded;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipListed;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipRetrieved;
use HWafeq\LaravelWafeq\Events\Payslips\PayslipUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists payslips', function () {
    Event::fake([PayslipListed::class]);
    $this->fakeWafeqPage('/payslips/', [
        ['id' => 'ps_1', 'reference' => 'PS-001', 'status' => 'APPROVED', 'total' => '5000.00', 'currency' => 'SAR', 'periodStart' => '2024-01-01', 'periodEnd' => '2024-01-31'],
    ]);

    $page = LaravelWafeq::payslips()->list();

    expect($page->results[0])->toBeInstanceOf(PayslipData::class)
        ->and($page->results[0]->status)->toBe('APPROVED');

    Event::assertDispatched(PayslipListed::class);
});

it('creates a payslip', function () {
    Event::fake([PayslipCreated::class]);
    $this->fakeWafeq('/payslips/', ['id' => 'ps_new', 'reference' => 'PS-002', 'status' => 'DRAFT', 'total' => '6000.00', 'currency' => 'SAR']);

    $ps = LaravelWafeq::payslips()->create([
        'employee' => 'e_1',
        'period_start' => '2024-01-01',
        'period_end' => '2024-01-31',
        'currency' => 'SAR',
    ]);

    expect($ps->id)->toBe('ps_new');

    Event::assertDispatched(PayslipCreated::class);
});

it('retrieves a payslip', function () {
    Event::fake([PayslipRetrieved::class]);
    $this->fakeWafeq('/payslips/ps_1/', ['id' => 'ps_1', 'reference' => 'PS-001', 'status' => 'APPROVED', 'total' => '5000.00', 'currency' => 'SAR']);

    $ps = LaravelWafeq::payslips()->retrieve('ps_1');

    expect($ps->id)->toBe('ps_1');

    Event::assertDispatched(PayslipRetrieved::class);
});

it('updates a payslip', function () {
    Event::fake([PayslipUpdated::class]);
    $this->fakeWafeq('/payslips/ps_1/', ['id' => 'ps_1', 'reference' => 'PS-001', 'status' => 'PAID', 'total' => '5000.00', 'currency' => 'SAR']);

    $ps = LaravelWafeq::payslips()->update('ps_1', ['status' => 'PAID']);

    expect($ps->status)->toBe('PAID');

    Event::assertDispatched(PayslipUpdated::class);
});

it('partial updates a payslip', function () {
    Event::fake([PayslipPartiallyUpdated::class]);
    $this->fakeWafeq('/payslips/ps_1/', ['id' => 'ps_1', 'reference' => 'PS-001', 'status' => 'PAID', 'total' => '5000.00', 'currency' => 'SAR']);

    $ps = LaravelWafeq::payslips()->partialUpdate('ps_1', ['status' => 'PAID']);

    expect($ps->status)->toBe('PAID');

    Event::assertDispatched(PayslipPartiallyUpdated::class);
});

it('destroys a payslip', function () {
    Event::fake([PayslipDestroyed::class]);
    $this->fakeWafeq('/payslips/ps_1/', '', 204);

    expect(LaravelWafeq::payslips()->destroy('ps_1'))->toBeTrue();

    Event::assertDispatched(PayslipDestroyed::class);
});

it('downloads a payslip', function () {
    Event::fake([PayslipDownloaded::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/payslips/ps_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::payslips()->download('ps_1');

    expect($response->body())->toBe('PDF');

    Event::assertDispatched(PayslipDownloaded::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/payslips/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::payslips()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(PayslipData::class)
        ->and($result->id)->toBe('m_1');
});
