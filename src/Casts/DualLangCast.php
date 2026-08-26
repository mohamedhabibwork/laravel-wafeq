<?php

namespace HWafeq\LaravelWafeq\Casts;

use HWafeq\LaravelWafeq\Data\Shared\DualLangData;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\IterableItemCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

/**
 * Normalises a wire-format value into a {@see DualLangData} instance.
 *
 * Accepts any of:
 *  - a {@see DualLangData} (passes through)
 *  - an array shaped as `['en' => ..., 'ar' => ...]` (normalises both keys)
 *  - a plain string (wraps it as `{en: $string, ar: null}`)
 *  - null (returns null)
 *
 * Anything else yields null — the field is then captured by the DTO's
 * `extra` array so callers never lose data on shape drift.
 */
/**
 * Normalises a wire-format value into a {@see DualLangData} instance.
 *
 * Accepts any of:
 *  - a {@see DualLangData} (passes through)
 *  - an array shaped as `['en' => ..., 'ar' => ...]` (normalises both keys)
 *  - a plain string (wraps it as `{en: $string, ar: null}`)
 *  - null (returns null)
 *
 * Anything else yields null — the field is then captured by the DTO's
 * `extra` array so callers never lose data on shape drift.
 */
class DualLangCast implements Cast, IterableItemCast
{
    /**
     * @param  array<string, mixed>  $properties
     * @param  CreationContext<Data>  $context
     */
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return $this->normalize($value);
    }

    /**
     * @param  array<string, mixed>  $properties
     * @param  CreationContext<Data>  $context
     */
    public function castIterableItem(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return $this->normalize($value);
    }

    protected function normalize(mixed $value): ?DualLangData
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof DualLangData) {
            return $value;
        }

        if (is_string($value)) {
            return new DualLangData(en: $value, ar: null);
        }

        if (is_array($value)) {
            $en = $value['en'] ?? $value['EN'] ?? null;
            $ar = $value['ar'] ?? $value['AR'] ?? null;

            if ($en === null && $ar === null) {
                return null;
            }

            return new DualLangData(
                en: (string) ($en ?? ''),
                ar: $ar !== null ? (string) $ar : null,
            );
        }

        return null;
    }
}
