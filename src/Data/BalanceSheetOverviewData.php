<?php

namespace HWafeq\LaravelWafeq\Data;

use HWafeq\LaravelWafeq\Enums\Currency;
use Spatie\LaravelData\Data;

/**
 * @property string $createdTs
 * @property ?Currency $currency
 * @property string $date
 * @property array<string, mixed> $filters
 * @property string $groupBy
 * @property string $id
 * @property string $label
 * @property int $periodCount
 * @property array<string, mixed> $extra
 */
/**
 * BalanceSheetOverviewData Data Transfer Object.
 *
 * Overview block of a `/reports/balance-sheet/` response. Mirrors
 * Wafeq's `api-v1-external-reports-balance-sheet-overview-read` schema.
 *
 * @see LaravelWafeq
 */
class BalanceSheetOverviewData extends Data
{
    /**
     * @param  array<string, mixed>  $filters
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $createdTs = '',
        public ?Currency $currency = null,
        public string $date = '',
        public array $filters = [],
        public string $groupBy = '',
        public string $id = 'balance_sheet',
        public string $label = 'Balance Sheet Report',
        public int $periodCount = 0,
        public array $extra = [],
    ) {}
}
