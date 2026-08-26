<?php

namespace HWafeq\LaravelWafeq\Data;

use HWafeq\LaravelWafeq\Data\Shared\DualLangData;
use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property DualLangData $name
 * @property string $code
 * @property string $account
 * @property DualLangData $city
 * @property DualLangData $district
 * @property DualLangData $address
 * @property string $phone
 * @property string $postalCode
 * @property string $buildingNumber
 * @property string $legacyId
 * @property string $createdTs
 * @property string $modifiedTs
 * @property bool $isActive
 * @property ?string $state
 * @property array<string, mixed> $extra
 */
/**
 * OrganizationWarehouseData Data Transfer Object.
 *
 * Full warehouse summary embedded inside `OrganizationData.warehouses[]`.
 * Mirrors Wafeq's `Warehouse` schema (used inside the organization
 * envelope) — for the CRUD-shrunk warehouse, see `WarehouseData`.
 *
 * @see LaravelWafeq
 */
class OrganizationWarehouseData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public DualLangData $name = new DualLangData('', null),
        public string $code = '',
        public string $account = '',
        public DualLangData $city = new DualLangData('', null),
        public DualLangData $district = new DualLangData('', null),
        public DualLangData $address = new DualLangData('', null),
        public string $phone = '',
        public string $postalCode = '',
        public string $buildingNumber = '',
        public string $legacyId = '',
        public string $createdTs = '',
        public string $modifiedTs = '',
        public bool $isActive = true,
        public ?string $state = null,
        public array $extra = [],
    ) {}
}
