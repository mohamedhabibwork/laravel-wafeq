<?php

namespace HWafeq\LaravelWafeq\Casts;

use BackedEnum;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

/**
 * Casts a wire value to the property's backed enum, or `null` when the
 * value is empty or unknown.
 *
 * Used on response DTOs so a value Wafeq adds later (a new status, say)
 * never breaks hydration of an otherwise valid response.
 *
 * ```php
 * #[WithCast(LenientEnumCast::class)]
 * public ?ZatcaDeviceStatus $status = null,
 * ```
 */
class LenientEnumCast implements Cast
{
    /**
     * @param  array<string, mixed>  $properties
     * @param  CreationContext<Data>  $context
     */
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if ($value instanceof BackedEnum) {
            return $value;
        }

        $enumClass = $property->type->type->findAcceptedTypeForBaseType(BackedEnum::class);

        if ($enumClass === null || ! is_subclass_of($enumClass, BackedEnum::class)) {
            return Uncastable::create();
        }

        if (! is_string($value) && ! is_int($value)) {
            return null;
        }

        return $enumClass::tryFrom($value);
    }
}
