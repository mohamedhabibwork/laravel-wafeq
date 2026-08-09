<?php

use HWafeq\LaravelWafeq\Data\TaxRateData;
use HWafeq\LaravelWafeq\Events\TaxRates\TaxRateListed;
use HWafeq\LaravelWafeq\Events\TaxRates\TaxRateRetrieved;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists tax rates', function () {
    Event::fake([TaxRateListed::class]);
    $this->fakeWafeqPage('/tax-rates/', [
        ['id' => 'tx_1', 'name' => 'VAT 15%', 'rate' => '15', 'taxType' => 'VAT', 'country' => 'SA'],
        ['id' => 'tx_2', 'name' => 'VAT 5%', 'rate' => '5', 'taxType' => 'VAT', 'country' => 'SA'],
    ]);

    $page = LaravelWafeq::taxRates()->list();

    expect($page->results)->toHaveCount(2)
        ->and($page->results[0])->toBeInstanceOf(TaxRateData::class)
        ->and($page->results[0]->taxType)->toBe('VAT');

    Event::assertDispatched(TaxRateListed::class);
});

it('retrieves a tax rate', function () {
    Event::fake([TaxRateRetrieved::class]);
    $this->fakeWafeq('/tax-rates/tx_1/', ['id' => 'tx_1', 'name' => 'VAT 15%', 'rate' => '15', 'taxType' => 'VAT', 'country' => 'SA']);

    $tx = LaravelWafeq::taxRates()->retrieve('tx_1');

    expect($tx->id)->toBe('tx_1')
        ->and($tx->rate)->toBe('15');

    Event::assertDispatched(TaxRateRetrieved::class);
});

it('forwards country filter when listing tax rates', function () {
    Event::fake([TaxRateListed::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/tax-rates/*' => Http::response([
            'count' => 0, 'next' => null, 'previous' => null, 'results' => [],
        ]),
    ]);

    LaravelWafeq::taxRates()->list(['country' => 'SA']);

    Http::assertSent(function ($request) {
        return $request->method() === 'GET'
            && str_contains($request->url(), '/tax-rates/')
            && $request->data() === ['country' => 'SA'];
    });

    Event::assertDispatched(TaxRateListed::class);
});
