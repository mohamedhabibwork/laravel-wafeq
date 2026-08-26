<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $type
 * @property string $value
 * @property array<string, mixed> $extra
 */
/**
 * CompanyIdentificationData Data Transfer Object.
 *
 * Single entry in `OrganizationFinancialSettings.company_identification[]`.
 * Mirrors Wafeq's `_CompanyIdentificationSupplierSchema`:
 * `type` is one of CRN, MLS, SAG, MOM, 700, OTH, TRD; `value` is the
 * matching identifier string.
 *
 * @see LaravelWafeq
 */
class CompanyIdentificationData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $type = '',
        public string $value = '',
        public array $extra = [],
    ) {}
}
