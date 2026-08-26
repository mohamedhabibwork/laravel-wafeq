<?php

namespace HWafeq\LaravelWafeq\Attributes;

use Attribute;
use HWafeq\LaravelWafeq\Casts\WithCurrencyCast;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Attributes\GetsCast;

/**
 * Marker attribute for DTO properties typed as `?Currency`.
 *
 * When a wire response leaves the tagged property `null` (or empty /
 * unknown), Spatie Data fills it with the package's configured
 * `defaultCurrency()` — first from `config/wafeq.php` (or the
 * `WAFEQ_CURRENCY` env var), then from the authenticated organisation's
 * `financial_settings.base_currency` via `GET /organization/`.
 *
 * Usage:
 *
 * ```php
 * use HWafeq\LaravelWafeq\Attributes\WithCurrency;
 * use HWafeq\LaravelWafeq\Enums\Currency;
 *
 * class InvoiceData extends Data
 * {
 *     public function __construct(
 *         public string $id = '',
 *         #[WithCurrency]
 *         public ?Currency $currency = null,
 *         // ...
 *     ) {}
 * }
 * ```
 *
 * The attribute is opt-in: without `#[WithCurrency]`, the property stays
 * whatever the wire value was. Drop the attribute on every DTO that
 * needs the organisation base-currency fallback.
 *
 * @see \HWafeq\LaravelWafeq\Casts\WithCurrencyCast
 * @see \HWafeq\LaravelWafeq\Client::defaultCurrency()
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER)]
class WithCurrency implements GetsCast
{
    public function get(): Cast
    {
        return new WithCurrencyCast();
    }
}
