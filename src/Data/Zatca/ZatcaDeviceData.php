<?php

namespace HWafeq\LaravelWafeq\Data\Zatca;

use HWafeq\LaravelWafeq\Casts\LenientEnumCast;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDeviceStatus;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * A device (solution unit) registered with ZATCA to report documents.
 *
 * Mirrors the Wafeq ZATCA `device-read` schema.
 */
class ZatcaDeviceData extends Data
{
    public function __construct(
        public string $id = '',
        public string $commonName = '',
        #[WithCast(LenientEnumCast::class)]
        public ?ZatcaDeviceStatus $status = null,
        public string $branch = '',
        public ?string $connectedAccount = null,
    ) {}

    public function isActive(): bool
    {
        return $this->status === ZatcaDeviceStatus::Active;
    }
}
