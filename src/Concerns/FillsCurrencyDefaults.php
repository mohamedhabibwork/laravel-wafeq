<?php

namespace HWafeq\LaravelWafeq\Concerns;

use HWafeq\LaravelWafeq\Attributes\WithCurrency;
use HWafeq\LaravelWafeq\Contracts\ClientContract;
use HWafeq\LaravelWafeq\Enums\Currency;
use ReflectionClass;
use ReflectionProperty;

/**
 * Post-construction hook that walks a DTO via reflection and fills in any
 * `#[WithCurrency]`-tagged nullable property whose current value is `null`
 * with the package's configured default currency.
 *
 * Wired into Spatie Data's pipeline via {@see WithCurrencyDefaultsPipe}, so
 * every `Data::from()` call transparently hydrates currency fallbacks for
 * tagged properties — no manual call to a `withDefaultCurrency()` helper
 * needed at the call site.
 */
trait FillsCurrencyDefaults
{
    /**
     * @template T of object
     *
     * @param  T  $dto
     * @return T
     */
    public function fillCurrencyDefaults(object $dto): object
    {
        if (! config()->has('wafeq')) {
            return $dto;
        }

        $client = $this->resolveClient();
        $default = $client?->defaultCurrency();

        if (! $default instanceof Currency) {
            return $dto;
        }

        $reflection = new ReflectionClass($dto);

        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $attributes = $property->getAttributes(WithCurrency::class);

            if (empty($attributes)) {
                continue;
            }

            if (! $property->isInitialized($dto)) {
                $property->setValue($dto, $default);

                continue;
            }

            $current = $property->getValue($dto);
            if ($current === null) {
                $property->setValue($dto, $default);
            }
        }

        return $dto;
    }

    private function resolveClient(): ?ClientContract
    {
        try {
            if (function_exists('app') && app()->bound(ClientContract::class)) {
                /** @var ClientContract $client */
                $client = app(ClientContract::class);

                return $client;
            }
        } catch (\Throwable) {
            return null;
        }

        return null;
    }
}
