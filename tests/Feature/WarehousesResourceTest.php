<?php

use HWafeq\LaravelWafeq\Data\Shared\DualLangData;
use HWafeq\LaravelWafeq\Data\WarehouseData;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseCreated;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseDestroyed;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseListed;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehousePartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseRetrieved;
use HWafeq\LaravelWafeq\Events\Warehouses\WarehouseUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

beforeEach(function () {
    $this->warehousePayload = function (array $overrides = []): array {
        return array_merge([
            'id' => 'w_1',
            'account' => 'acc_1',
            'name' => ['en' => 'Main Warehouse', 'ar' => 'المستودع الرئيسي'],
            'code' => 'WH-001',
            'address' => ['en' => 'Industrial Area', 'ar' => 'المنطقة الصناعية'],
            'building_number' => '1234',
            'city' => ['en' => 'Riyadh', 'ar' => 'الرياض'],
            'district' => ['en' => 'Al Olaya', 'ar' => 'العليا'],
            'phone' => '+966500000001',
            'postal_code' => '11564',
            'state' => '',
            'is_active' => true,
            'legacy_id' => 'w_1_legacy',
            'created_ts' => '2024-01-01T00:00:00Z',
            'modified_ts' => '2024-01-01T00:00:00Z',
        ], $overrides);
    };
});

it('lists warehouses', function () {
    Event::fake([WarehouseListed::class]);
    $payload = $this->warehousePayload;
    $this->fakeWafeqPage('/warehouses/', [$payload()]);

    $page = LaravelWafeq::warehouses()->list();

    expect($page->results[0])->toBeInstanceOf(WarehouseData::class)
        ->and($page->results[0]->code)->toBe('WH-001')
        ->and($page->results[0]->name)->toBeInstanceOf(DualLangData::class)
        ->and($page->results[0]->name->en)->toBe('Main Warehouse')
        ->and($page->results[0]->name->ar)->toBe('المستودع الرئيسي')
        ->and($page->results[0]->isActive)->toBeTrue()
        ->and($page->results[0]->buildingNumber)->toBe('1234')
        ->and($page->results[0]->postalCode)->toBe('11564')
        ->and($page->results[0]->phone)->toBe('+966500000001')
        ->and($page->results[0]->account)->toBe('acc_1');

    Event::assertDispatched(WarehouseListed::class);
});

it('creates a warehouse', function () {
    Event::fake([WarehouseCreated::class]);
    $payload = $this->warehousePayload;
    $this->fakeWafeq('/warehouses/', $payload([
        'id' => 'w_new',
        'code' => 'WH-002',
        'name' => ['en' => 'Secondary Warehouse'],
    ]));

    $w = LaravelWafeq::warehouses()->create([
        'account' => 'acc_1',
        'name' => ['en' => 'Secondary Warehouse'],
        'code' => 'WH-002',
        'address' => ['en' => 'Industrial Area 2'],
        'building_number' => '5678',
        'city' => ['en' => 'Jeddah'],
        'district' => ['en' => 'Al Hamra'],
        'phone' => '+966500000002',
        'postal_code' => '21577',
    ]);

    expect($w->id)->toBe('w_new')
        ->and($w->name->en)->toBe('Secondary Warehouse')
        ->and($w->displayName())->toBe('Secondary Warehouse');

    Event::assertDispatched(WarehouseCreated::class);
});

it('retrieves a warehouse', function () {
    Event::fake([WarehouseRetrieved::class]);
    $payload = $this->warehousePayload;
    $this->fakeWafeq('/warehouses/w_1/', $payload());

    $w = LaravelWafeq::warehouses()->retrieve('w_1');

    expect($w->id)->toBe('w_1')
        ->and($w->city->en)->toBe('Riyadh');

    Event::assertDispatched(WarehouseRetrieved::class);
});

it('updates a warehouse', function () {
    Event::fake([WarehouseUpdated::class]);
    $payload = $this->warehousePayload;
    $this->fakeWafeq('/warehouses/w_1/', $payload([
        'name' => ['en' => 'Renamed Warehouse'],
    ]));

    $w = LaravelWafeq::warehouses()->update('w_1', ['name' => ['en' => 'Renamed Warehouse']]);

    expect($w->name->en)->toBe('Renamed Warehouse');

    Event::assertDispatched(WarehouseUpdated::class);
});

it('partial updates a warehouse', function () {
    Event::fake([WarehousePartiallyUpdated::class]);
    $payload = $this->warehousePayload;
    $this->fakeWafeq('/warehouses/w_1/', $payload([
        'city' => ['en' => 'Dubai', 'ar' => 'دبي'],
    ]));

    $w = LaravelWafeq::warehouses()->partialUpdate('w_1', ['city' => ['en' => 'Dubai']]);

    expect($w->city->en)->toBe('Dubai');

    Event::assertDispatched(WarehousePartiallyUpdated::class);
});

it('destroys a warehouse', function () {
    Event::fake([WarehouseDestroyed::class]);
    $this->fakeWafeq('/warehouses/w_1/', '', 204);

    expect(LaravelWafeq::warehouses()->destroy('w_1'))->toBeTrue();

    Event::assertDispatched(WarehouseDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $payload = $this->warehousePayload;
    $this->fakeWafeq('/warehouses/m_1/', $payload(['id' => 'm_1']));

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::warehouses()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(WarehouseData::class)
        ->and($result->id)->toBe('m_1');
});

it('renders the localised warehouse address', function () {
    $w = new WarehouseData(
        id: 'w_1',
        account: 'acc_1',
        address: new DualLangData(en: 'Industrial Area', ar: 'المنطقة الصناعية'),
        buildingNumber: '1234',
        city: new DualLangData(en: 'Riyadh', ar: 'الرياض'),
        code: 'WH-001',
        district: new DualLangData(en: 'Al Olaya', ar: 'العليا'),
        name: new DualLangData(en: 'Main Warehouse', ar: 'المستودع الرئيسي'),
        phone: '+966500000001',
        postalCode: '11564',
        state: '',
    );

    expect($w->fullAddress('en'))->toContain('Industrial Area')
        ->toContain('1234')
        ->toContain('Al Olaya')
        ->toContain('Riyadh')
        ->toContain('11564');

    expect($w->fullAddress('ar'))->toContain('المنطقة الصناعية')
        ->toContain('الرياض')
        ->toContain('العليا');
});
