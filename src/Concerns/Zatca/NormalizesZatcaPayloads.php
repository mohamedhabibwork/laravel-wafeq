<?php

namespace HWafeq\LaravelWafeq\Concerns\Zatca;

use BackedEnum;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaPayloadData;
use Spatie\LaravelData\Data;

/**
 * Lets ZATCA resources accept typed payload DTOs anywhere they accept
 * arrays, converting either into the snake_case wire format.
 */
trait NormalizesZatcaPayloads
{
    /**
     * @param  array<array-key, mixed>|Data  $value
     * @return array<array-key, mixed>
     */
    protected function toWire(array|Data $value): array
    {
        if ($value instanceof ZatcaPayloadData) {
            return $value->toPayload();
        }

        if ($value instanceof Data) {
            return $value->toArray();
        }

        return array_map(fn (mixed $item): mixed => $this->wireValue($item), $value);
    }

    /**
     * Normalise a list of request bodies for a bulk endpoint.
     *
     * @param  array<array-key, array<string, mixed>|Data>  $payloads
     * @return list<array<array-key, mixed>>
     */
    protected function toWireList(array $payloads): array
    {
        return array_values(array_map(fn (array|Data $payload): array => $this->toWire($payload), $payloads));
    }

    private function wireValue(mixed $value): mixed
    {
        return match (true) {
            $value instanceof Data, is_array($value) => $this->toWire($value),
            $value instanceof BackedEnum => $value->value,
            default => $value,
        };
    }
}
