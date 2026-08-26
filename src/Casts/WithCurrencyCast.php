<?php

namespace HWafeq\LaravelWafeq\Casts;

use HWafeq\LaravelWafeq\Enums\Currency;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\IterableItemCast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

/**
 * Spatie Data cast applied (automatically, by Spatie's Castable attribute
 * detection) on every DTO property typed `?Currency`.
 *
 * Behaviour:
 *  - If the wire value is already a `Currency` instance, it passes through.
 *  - If the wire value is a non-empty string and a known ISO-4217 case,
 *    it converts to the matching enum case.
 *  - If the wire value is `null`, empty string, or unknown — the cast
 *    resolves the package's `defaultCurrency()` (cached on the client)
 *    and falls back to it. That means a missing `currency` field on a
 *    payload silently hydrates to the organisation's base currency.
 *  - If even the default resolution fails, the property stays `null`.
 *
 * @see \HWafeq\LaravelWafeq\Attributes\WithCurrency
 * @see \HWafeq\LaravelWafeq\Client::defaultCurrency()
 */
class WithCurrencyCast implements Cast, IterableItemCast
{
    /**
     * @param  array<string, mixed>  $properties
     * @param  CreationContext<\Spatie\LaravelData\Data>  $context
     */
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return $this->resolve($value);
    }

    /**
     * @param  array<string, mixed>  $properties
     * @param  CreationContext<\Spatie\LaravelData\Data>  $context
     */
    public function castIterableItem(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return $this->resolve($value);
    }

    protected function resolve(mixed $value): ?Currency
    {
        // Pass-through when Spatie Data already gave us an enum.
        if ($value instanceof Currency) {
            return $value;
        }

        // Empty / null wire value -> try the configured default.
        if ($value === null || $value === '') {
            return $this->defaultCurrency();
        }

        if (is_string($value)) {
            $enum = Currency::tryFrom($value);
            if ($enum instanceof Currency) {
                return $enum;
            }

            // Unknown string — still try the default rather than throwing.
            return $this->defaultCurrency();
        }

        return $this->defaultCurrency();
    }

    private function defaultCurrency(): ?Currency
    {
        $client = null;

        try {
            if (function_exists('app') && app()->bound(\HWafeq\LaravelWafeq\Contracts\ClientContract::class)) {
                /** @var \HWafeq\LaravelWafeq\Contracts\ClientContract $client */
                $client = app(\HWafeq\LaravelWafeq\Contracts\ClientContract::class);
            }
        } catch (\Throwable) {
            $client = null;
        }

        return $client?->defaultCurrency();
    }
}
