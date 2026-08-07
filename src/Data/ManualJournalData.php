<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property ?string $reference
 * @property ?string $date
 * @property ?string $narration
 * @property ?string $currency
 * @property ?string $totalDebit
 * @property ?string $totalCredit
 * @property array<string, mixed> $extra
 */
/**
 * ManualJournalData Data Transfer Object.
 *
 * @see LaravelWafeq
 */
class ManualJournalData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public ?string $reference = null,
        public ?string $date = null,
        public ?string $narration = null,
        public ?string $currency = null,
        public ?string $totalDebit = null,
        public ?string $totalCredit = null,
        public array $extra = [],
    ) {}
}
