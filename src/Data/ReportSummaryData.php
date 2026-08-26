<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $label
 * @property array<string, mixed> $metadata
 * @property array<int, float|int|string> $subTotals
 * @property array<string, mixed> $extra
 */
/**
 * ReportSummaryData Data Transfer Object.
 *
 * Summary line on a report row, section, or sub-section. Carries an id
 * (often a `summary_<id>` identifier), a localised label, free-form
 * metadata, and the sub-totals indexed by report column.
 *
 * @see LaravelWafeq
 */
class ReportSummaryData extends Data
{
    /**
     * @param  array<string, mixed>  $metadata
     * @param  array<int, float|int|string>  $subTotals
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $label = '',
        public array $metadata = [],
        public array $subTotals = [],
        public array $extra = [],
    ) {}
}
