<?php

namespace HWafeq\LaravelWafeq\Data;

use HWafeq\LaravelWafeq\Data\Shared\CompanyIdentificationData;
use HWafeq\LaravelWafeq\Data\Shared\DualLangData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @property DualLangData $address
 * @property string $baseCurrency
 * @property DualLangData $city
 * @property DataCollection<int, CompanyIdentificationData> $companyIdentification
 * @property ?string $country
 * @property DualLangData $district
 * @property string $phone
 * @property ?string $state
 * @property string $taxIdentificationNumber
 * @property string $taxRegistrationNumber
 * @property array<string, mixed> $extra
 */
/**
 * OrganizationFinancialSettingsData Data Transfer Object.
 *
 * Embedded inside `OrganizationData.financial_settings`. Mirrors Wafeq's
 * `OrganizationFinancialSettings` schema: address/city/district are
 * dual-language, `baseCurrency`/`phone`/`tax_*` are required string
 * fields, `country`/`state` are read-only.
 *
 * @see LaravelWafeq
 */
class OrganizationFinancialSettingsData extends Data
{
    /**
     * @param  DataCollection<int, CompanyIdentificationData>|array<int, CompanyIdentificationData>  $companyIdentification
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public DualLangData $address = new DualLangData('', null),
        public string $baseCurrency = '',
        public DualLangData $city = new DualLangData('', null),
        public DataCollection|array $companyIdentification = [],
        public ?string $country = null,
        public DualLangData $district = new DualLangData('', null),
        public string $phone = '',
        public ?string $state = null,
        public string $taxIdentificationNumber = '',
        public string $taxRegistrationNumber = '',
        public array $extra = [],
    ) {}
}
