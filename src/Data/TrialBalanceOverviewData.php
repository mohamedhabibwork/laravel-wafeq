<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property int $count
 * @property string $createdTs
 * @property array<string, mixed> $filters
 * @property string $fromDate
 * @property string $id
 * @property bool $includeZeroBalances
 * @property string $label
 * @property string $toDate
 * @property bool $withPnlOpenings
 * @property array<string, mixed> $extra
 */
/**
 * TrialBalanceOverviewData Data Transfer Object.
 *
 * Overview block of a `/reports/trial-balance/` response. Mirrors
 * Wafeq's `api-v1-external-reports-trial-balance-overview-read`
 * schema.
 *
 * @see LaravelWafeq
 */
class TrialBalanceOverviewData extends Data
{
    /**
     * @param  array<string, mixed>  $filters
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public int $count = 0,
        public string $createdTs = '',
        public array $filters = [],
        public string $fromDate = '',
        public string $id = 'trial_balance',
        public bool $includeZeroBalances = false,
        public string $label = 'Trial Balance Report',
        public string $toDate = '',
        public bool $withPnlOpenings = false,
        public array $extra = [],
    ) {}
}
