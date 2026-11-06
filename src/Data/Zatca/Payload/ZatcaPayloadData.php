<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use BackedEnum;
use Spatie\LaravelData\Data;

/**
 * Base class for every typed ZATCA request payload.
 *
 * {@see self::toPayload()} produces the snake_case wire format with unset
 * (`null`) optional fields removed, so ZATCA applies its own defaults
 * instead of rejecting explicit nulls. Enums nested in plain arrays
 * (e.g. `indicators`) are reduced to their wire values.
 */
abstract class ZatcaPayloadData extends Data
{
    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        /** @var array<string, mixed> $payload */
        $payload = self::withoutNulls($this->toArray());

        return $payload;
    }

    /**
     * @param  array<array-key, mixed>  $values
     * @return array<array-key, mixed>
     */
    protected static function withoutNulls(array $values): array
    {
        $clean = [];

        foreach ($values as $key => $value) {
            if ($value === null) {
                continue;
            }

            $clean[$key] = match (true) {
                is_array($value) => self::withoutNulls($value),
                $value instanceof BackedEnum => $value->value,
                default => $value,
            };
        }

        return $clean;
    }
}
