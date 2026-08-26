<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property float|int $creditToBcy
 * @property float|int $debitToBcy
 * @property float|int $openingBalanceToBcy
 * @property float|int $runningBalanceToBcy
 * @property array<string, mixed> $extra
 */
/**
 * TrialBalanceTotalsData Data Transfer Object.
 *
 * Totals block used inside the trial-balance summary and section
 * summaries. Mirrors Wafeq's `_TrialBalanceTotalsRead` schema — all
 * four fields are credits/debits/balances in the organization's base
 * currency (BCY).
 *
 * @see LaravelWafeq
 */
class TrialBalanceTotalsData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public float|int $creditToBcy = 0,
        public float|int $debitToBcy = 0,
        public float|int $openingBalanceToBcy = 0,
        public float|int $runningBalanceToBcy = 0,
        public array $extra = [],
    ) {}
}
