<?php

namespace HWafeq\LaravelWafeq\Data;

use HWafeq\LaravelWafeq\Enums\Currency;
use Spatie\LaravelData\Data;

/**
 * @property string $createdTs
 * @property ?Currency $currency
 * @property string $dateFrom
 * @property string $dateTo
 * @property array<string, mixed> $filters
 * @property string $groupBy
 * @property string $id
 * @property string $label
 * @property array<string, mixed> $extra
 */
/**
 * ProfitAndLossOverviewData Data Transfer Object.
 *
 * Overview block of a `/reports/profit-and-loss/` response. Mirrors
 * Wafeq's `api-v1-external-reports-profit-and-loss-overview-read`
 * schema.
 *
 * @see LaravelWafeq
 */
class ProfitAndLossOverviewData extends Data
{
    /**
     * @param  array<string, mixed>  $filters
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $createdTs = '',
        public ?Currency $currency = null,
        public string $dateFrom = '',
        public string $dateTo = '',
        public array $filters = [],
        public string $groupBy = '',
        public string $id = 'profit_and_loss',
        public string $label = 'Profit and Loss Report',
        public array $extra = [],
    ) {}
}
