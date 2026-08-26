<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\ItemData;
use HWafeq\LaravelWafeq\Requests\Items\CreateItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a fully-populated item payload', function () {
    $payload = [
        'name' => 'Office Chair',
        'description' => 'Ergonomic mesh chair',
        'sku' => 'CHAIR-001',
        'external_id' => 'ext-001',
        'is_active' => true,
        'is_tracked_inventory' => false,
        'expense_account' => 'acc_exp',
        'revenue_account' => 'acc_rev',
        'purchase_tax_rate' => 'tax_std',
        'revenue_tax_rate' => 'tax_std',
        'unit_cost' => 120.50,
        'unit_price' => 199.99,
        'item_units_of_measure' => [
            [
                'unit_of_measure' => 'uom_each',
                'conversion_factor' => 1,
                'is_base' => true,
                'is_active' => true,
                'unit_cost' => 120.50,
                'unit_price' => 199.99,
            ],
        ],
        'tax_authority' => [
            'metadata' => ['default_exemption_reason' => null],
        ],
    ];

    $request = CreateItemRequest::create('/items/', 'POST', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(ItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();

    $request->merge($payload);
    $request->validateResolved();
    $dto = $request->toDto();
    expect($dto)->toBeInstanceOf(ItemData::class)
        ->and($dto->id)->toBe('');
});

it('rejects an item payload missing the name', function () {
    $request = CreateItemRequest::create('/items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeTrue()
        ->and($validator->errors()->has('name'))->toBeTrue();
});

it('rejects a uom row missing the conversion_factor', function () {
    $request = CreateItemRequest::create('/items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        [
            'name' => 'Item',
            'item_units_of_measure' => [
                ['unit_of_measure' => 'uom_each'],
            ],
        ],
        [
            'item_units_of_measure' => $request->rules()['item_units_of_measure'],
            'item_units_of_measure.*' => $request->rules()['item_units_of_measure.*'],
            'item_units_of_measure.*.conversion_factor' => $request->rules()['item_units_of_measure.*.conversion_factor'],
            'item_units_of_measure.*.unit_of_measure' => $request->rules()['item_units_of_measure.*.unit_of_measure'],
        ],
    );

    expect($validator->fails())->toBeTrue();
});

it('rejects an over-long external_id', function () {
    $request = CreateItemRequest::create('/items/', 'POST', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['external_id' => str_repeat('a', 256)],
        ['external_id' => $request->rules()['external_id']],
    );

    expect($validator->fails())->toBeTrue();
});
