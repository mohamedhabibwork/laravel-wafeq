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
 * CashFlowOverviewData Data Transfer Object.
 *
 * Overview block of a `/reports/cash-flow/` response. Mirrors Wafeq's
 * `api-v1-external-reports-cash-flow-overview-read` schema.
 *
 * @see LaravelWafeq
 */
class CashFlowOverviewData extends Data
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
        public string $id = 'cash_flow',
        public string $label = 'Cash Flow Report',
        public array $extra = [],
    ) {}
}
