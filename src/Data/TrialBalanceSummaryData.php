<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $label
 * @property array<string, mixed> $metadata
 * @property TrialBalanceTotalsData $totals
 * @property array<string, mixed> $extra
 */
/**
 * TrialBalanceSummaryData Data Transfer Object.
 *
 * Summary block of a `/reports/trial-balance/` response. Mirrors
 * Wafeq's `api-v1-external-reports-trial-balance-summary-read` schema:
 * an id + label + free-form metadata + the matching
 * {@see TrialBalanceTotalsData} totals.
 *
 * @see LaravelWafeq
 */
class TrialBalanceSummaryData extends Data
{
    /**
     * @param  array<string, mixed>  $metadata
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $label = '',
        public array $metadata = [],
        public TrialBalanceTotalsData $totals = new TrialBalanceTotalsData,
        public array $extra = [],
    ) {}
}
