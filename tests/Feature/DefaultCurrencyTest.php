<?php

use HWafeq\LaravelWafeq\Contracts\ClientContract;
use HWafeq\LaravelWafeq\Enums\Currency;
use HWafeq\LaravelWafeq\Tests\Fixtures\CurrencyAwareData;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('returns the configured currency when WAFEQ_CURRENCY is set', function () {
    config()->set('wafeq.currency', 'AED');

    expect(app(ClientContract::class)->defaultCurrency())
        ->toBe(Currency::AED);
});

it('falls back to the organisation base currency when config is null', function () {
    config()->set('wafeq.currency', null);

    $this->fakeWafeq('/organization/', [
        'id' => 'org_1',
        'name' => 'Acme Co.',
        'financial_settings' => [
            'base_currency' => 'SAR',
            'address' => ['en' => 'Riyadh'],
            'city' => ['en' => 'Riyadh'],
            'district' => ['en' => 'Al Olaya'],
            'state' => '',
            'phone' => '+966500000001',
            'tax_identification_number' => '',
            'tax_registration_number' => '',
            'company_identification' => [],
        ],
        'created_ts' => '2024-01-01T00:00:00Z',
        'modified_ts' => '2024-01-01T00:00:00Z',
        'legacy_id' => '',
    ]);

    expect(app(ClientContract::class)->defaultCurrency())
        ->toBe(Currency::SAR);
});

it('caches the configured currency without hitting the organisation endpoint', function () {
    config()->set('wafeq.currency', 'USD');

    $this->fakeWafeq('/organization/', [], 500);

    $client = app(ClientContract::class);

    expect($client->defaultCurrency())->toBe(Currency::USD);
    expect($client->defaultCurrency())->toBe(Currency::USD);
});

it('returns null when no config and the organisation lookup fails', function () {
    config()->set('wafeq.currency', null);

    $this->fakeWafeq('/organization/', [], 500);

    expect(app(ClientContract::class)->defaultCurrency())
        ->toBeNull();
});

it('returns null for an unrecognised configured currency', function () {
    config()->set('wafeq.currency', 'NOT_A_REAL_CURRENCY');

    $this->fakeWafeq('/organization/', [], 500);

    expect(app(ClientContract::class)->defaultCurrency())
        ->toBeNull();
});

it('the cast resolves a known wire string to the matching Currency enum', function () {
    config()->set('wafeq.currency', 'AED');

    $result = CurrencyAwareData::from([
        'id' => 'demo_1',
        'currency' => 'USD',
    ]);

    expect($result->currency)->toBe(Currency::USD);
});

it('the post-construction fillCurrencyDefaults fills a null wire value with the configured default', function () {
    config()->set('wafeq.currency', 'AED');

    // Simulate what HandlesResponses::toData() does after from():
    // construct the DTO, then call fillCurrencyDefaults() on it.
    $result = CurrencyAwareData::from([
        'id' => 'demo_1',
        'currency' => null,
    ]);

    $client = app(ClientContract::class);
    $result = $client->fillCurrencyDefaults($result);

    expect($result->id)->toBe('demo_1')
        ->and($result->currency)->toBe(Currency::AED);
});

it('the cast falls back to the configured default when the wire value is an empty string', function () {
    config()->set('wafeq.currency', 'SAR');

    $result = CurrencyAwareData::from([
        'id' => 'demo_1',
        'currency' => '',
    ]);

    expect($result->currency)->toBe(Currency::SAR);
});

it('the cast falls back to the configured default for unknown wire values', function () {
    config()->set('wafeq.currency', 'EUR');

    $result = CurrencyAwareData::from([
        'id' => 'demo_1',
        'currency' => 'TOTALLY_MADE_UP',
    ]);

    expect($result->currency)->toBe(Currency::EUR);
});

it('the cast leaves the property null when no default is configured and wire is null', function () {
    config()->set('wafeq.currency', null);

    $this->fakeWafeq('/organization/', [], 500);

    $result = CurrencyAwareData::from([
        'id' => 'demo_1',
    ]);

    expect($result->currency)->toBeNull();
});
