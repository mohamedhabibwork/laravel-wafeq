<?php

namespace HWafeq\LaravelWafeq\Tests\Fixtures;

use HWafeq\LaravelWafeq\Attributes\WithCurrency;
use HWafeq\LaravelWafeq\Enums\Currency;
use Spatie\LaravelData\Data;

/**
 * Test fixture DTO that exercises the #[WithCurrency] attribute.
 *
 * The `currency` property is typed as `?Currency` and tagged with
 * `#[WithCurrency]`. When Spatie Data hydrates this DTO and the wire
 * payload has no / unknown / empty `currency` value, the cast fills
 * the property with the package's configured default.
 *
 * Note: `currency` is declared as a non-promoted property and assigned
 * in the constructor body so Spatie Data's CastPropertiesDataPipe runs
 * the cast — for promoted properties the cast pipeline is bypassed.
 */
class CurrencyAwareData extends Data
{
    public string $id;

    #[WithCurrency]
    public ?Currency $currency;

    public function __construct(string $id = '', ?Currency $currency = null)
    {
        $this->id = $id;
        $this->currency = $currency;
    }
}
