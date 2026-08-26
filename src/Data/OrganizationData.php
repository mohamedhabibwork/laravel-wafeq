<?php

namespace HWafeq\LaravelWafeq\Data;

use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $name
 * @property ?string $legalName
 * @property ?string $taxId
 * @property ?string $country
 * @property ?string $currency
 * @property ?string $timezone
 * @property ?string $logo
 * @property ?array<int, array<string, mixed>> $branches
 * @property ?string $createdTs
 * @property ?OrganizationFinancialSettingsData $financialSettings
 * @property ?string $legacyId
 * @property ?string $modifiedTs
 * @property ?array<int, array<string, mixed>> $users
 * @property ?array<int, array<string, mixed>> $warehouses
 * @property array<string, mixed> $extra
 *
 * OrganizationData Data Transfer Object.
 *
 * Mirrors the Wafeq `Organization` schema. Top-level scalars are typed
 * scalars; nested objects (`branches`, `users`, `warehouses`,
 * `financial_settings`) keep their existing typed sub-DTOs where
 * available — everything else flows into `extra`.
 *
 * @see LaravelWafeq
 */
class OrganizationData extends Data
{
    /**
     * @param  array<int, array<string, mixed>>  $branches
     * @param  array<int, array<string, mixed>>  $users
     * @param  array<int, array<string, mixed>>  $warehouses
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $name = '',
        public ?string $legalName = null,
        public ?string $taxId = null,
        public ?string $country = null,
        public ?string $currency = null,
        public ?string $timezone = null,
        public ?string $logo = null,
        public ?array $branches = null,
        public ?string $createdTs = null,
        public ?OrganizationFinancialSettingsData $financialSettings = null,
        public ?string $legacyId = null,
        public ?string $modifiedTs = null,
        public ?array $users = null,
        public ?array $warehouses = null,
        public array $extra = [],
    ) {}
}
