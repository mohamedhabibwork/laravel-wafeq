<?php

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryCreated;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryDestroyed;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryListed;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryRetrieved;
use HWafeq\LaravelWafeq\Events\Beneficiaries\BeneficiaryUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists beneficiaries', function () {
    Event::fake([BeneficiaryListed::class]);
    $this->fakeWafeqPage('/beneficiaries/', [
        ['id' => 'bn_1', 'name' => 'Acme Vendor', 'bankName' => 'SNB', 'iban' => 'SA4420000001234567890123', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::beneficiaries()->list();

    expect($page->results[0])->toBeInstanceOf(BeneficiaryData::class)
        ->and($page->results[0]->name)->toBe('Acme Vendor');

    Event::assertDispatched(BeneficiaryListed::class);
});

it('creates a beneficiary', function () {
    Event::fake([BeneficiaryCreated::class]);
    $this->fakeWafeq('/beneficiaries/', ['id' => 'bn_new', 'name' => 'New Vendor', 'currency' => 'SAR']);

    $b = LaravelWafeq::beneficiaries()->create(['name' => 'New Vendor', 'currency' => 'SAR']);

    expect($b->id)->toBe('bn_new');

    Event::assertDispatched(BeneficiaryCreated::class);
});

it('retrieves a beneficiary', function () {
    Event::fake([BeneficiaryRetrieved::class]);
    $this->fakeWafeq('/beneficiaries/bn_1/', ['id' => 'bn_1', 'name' => 'Acme Vendor', 'currency' => 'SAR']);

    $b = LaravelWafeq::beneficiaries()->retrieve('bn_1');

    expect($b->id)->toBe('bn_1');

    Event::assertDispatched(BeneficiaryRetrieved::class);
});

it('updates a beneficiary', function () {
    Event::fake([BeneficiaryUpdated::class]);
    $this->fakeWafeq('/beneficiaries/bn_1/', ['id' => 'bn_1', 'name' => 'Renamed', 'currency' => 'SAR']);

    $b = LaravelWafeq::beneficiaries()->update('bn_1', ['name' => 'Renamed']);

    expect($b->name)->toBe('Renamed');

    Event::assertDispatched(BeneficiaryUpdated::class);
});

it('partial updates a beneficiary', function () {
    Event::fake([BeneficiaryPartiallyUpdated::class]);
    $this->fakeWafeq('/beneficiaries/bn_1/', ['id' => 'bn_1', 'name' => 'Acme Vendor', 'currency' => 'USD']);

    $b = LaravelWafeq::beneficiaries()->partialUpdate('bn_1', ['currency' => 'USD']);

    expect($b->currency)->toBe('USD');

    Event::assertDispatched(BeneficiaryPartiallyUpdated::class);
});

it('destroys a beneficiary', function () {
    Event::fake([BeneficiaryDestroyed::class]);
    $this->fakeWafeq('/beneficiaries/bn_1/', '', 204);

    expect(LaravelWafeq::beneficiaries()->destroy('bn_1'))->toBeTrue();

    Event::assertDispatched(BeneficiaryDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/beneficiaries/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::beneficiaries()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(BeneficiaryData::class)
        ->and($result->id)->toBe('m_1');
});
