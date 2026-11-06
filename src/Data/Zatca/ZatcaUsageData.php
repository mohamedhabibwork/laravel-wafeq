<?php

namespace HWafeq\LaravelWafeq\Data\Zatca;

use HWafeq\LaravelWafeq\Casts\LenientEnumCast;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaWalletBalance;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * How many documents the organisation can still report to ZATCA.
 *
 * Mirrors the Wafeq ZATCA `usage-read` schema.
 */
class ZatcaUsageData extends Data
{
    public function __construct(
        public int $available = 0,
        #[WithCast(LenientEnumCast::class)]
        public ?ZatcaWalletBalance $balance = null,
        public int $debt = 0,
        public bool $enforced = false,
        public bool $exempt = false,
        public bool $simulation = false,
        public int $extrasAvailable = 0,
        public int $includedAvailable = 0,
        public ?string $includedExpiresTs = null,
        public int $packsAvailable = 0,
        public ?int $termAllowance = null,
        public int $termConsumed = 0,
        public int $termReserved = 0,
        public ?string $termStartsTs = null,
        public ?string $termEndsTs = null,
        public ?int $nextTermAllowance = null,
        public ?string $nextTermStartsTs = null,
    ) {}

    /**
     * Whether new production submissions will be refused right now.
     */
    public function isBlocked(): bool
    {
        return $this->enforced && ! $this->exempt && $this->balance === ZatcaWalletBalance::Out;
    }
}
