<?php

namespace HWafeq\LaravelWafeq\Data;

use HWafeq\LaravelWafeq\Data\Shared\DualLangData;
use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property DualLangData $name
 * @property DualLangData $city
 * @property DualLangData $district
 * @property DualLangData $address
 * @property string $phone
 * @property string $postalCode
 * @property string $buildingNumber
 * @property string $legacyId
 * @property bool $isActive
 * @property ?string $state
 * @property array<string, mixed> $extra
 */
/**
 * OrganizationBranchData Data Transfer Object.
 *
 * Minimal branch shape embedded inside `OrganizationData.branches[]`.
 * Mirrors Wafeq's `Branch` schema (used inside the organization
 * envelope) without `account`, `code`, `created_ts`, `modified_ts`,
 * `postal_code` aliases — see `BranchData` for the full CRUD branch.
 *
 * @see LaravelWafeq
 */
class OrganizationBranchData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public DualLangData $name = new DualLangData('', null),
        public DualLangData $city = new DualLangData('', null),
        public DualLangData $district = new DualLangData('', null),
        public DualLangData $address = new DualLangData('', null),
        public string $phone = '',
        public string $postalCode = '',
        public string $buildingNumber = '',
        public string $legacyId = '',
        public bool $isActive = true,
        public ?string $state = null,
        public array $extra = [],
    ) {}
}
