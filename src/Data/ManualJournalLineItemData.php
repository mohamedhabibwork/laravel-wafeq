<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $account
 * @property ?string $costCenter
 * @property ?string $createdTs
 * @property string $description
 * @property string $id
 * @property ?string $legacyId
 * @property ?string $modifiedTs
 * @property array<string, mixed> $extra
 *
 * Line item embedded inside a [PayslipData](../dtos.md). Mirrors the Wafeq
 * `ManualJournalLineItem` schema returned on `ManualJournal.line_items`.
 *
 * @see LaravelWafeq
 */
class ManualJournalLineItemData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $account = '',
        public ?string $costCenter = null,
        public ?string $createdTs = null,
        public string $description = '',
        public string $id = '',
        public ?string $legacyId = null,
        public ?string $modifiedTs = null,
        public array $extra = [],
    ) {}
}
