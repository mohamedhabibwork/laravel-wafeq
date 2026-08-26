<?php

namespace HWafeq\LaravelWafeq\Data;

use HWafeq\LaravelWafeq\Data\Shared\DualLangData;
use Spatie\LaravelData\Data;

/**
 * @property string $id
 * @property string $account
 * @property ?DualLangData $address
 * @property string $buildingNumber
 * @property ?DualLangData $city
 * @property string $code
 * @property string $createdTs
 * @property ?DualLangData $district
 * @property bool $isActive
 * @property string $legacyId
 * @property string $modifiedTs
 * @property ?DualLangData $name
 * @property string $phone
 * @property string $postalCode
 * @property string $state
 * @property array<string, mixed> $extra
 *
 * WarehouseData Data Transfer Object.
 *
 * Mirrors the Wafeq `Warehouse` schema. Localised fields (`name`, `city`,
 * `district`, `address`) are typed as {@see DualLangData} which carries
 * the `en` (required) + `ar` (optional) values, with `extra` capturing
 * any wire-format additions Wafeq ships later.
 *
 * @see LaravelWafeq
 */
class WarehouseData extends Data
{
    /**
     * @param  array<string, mixed>  $extra
     */
    public function __construct(
        public string $id = '',
        public string $account = '',
        public ?DualLangData $address = null,
        public string $buildingNumber = '',
        public ?DualLangData $city = null,
        public string $code = '',
        public string $createdTs = '',
        public ?DualLangData $district = null,
        public bool $isActive = true,
        public string $legacyId = '',
        public string $modifiedTs = '',
        public ?DualLangData $name = null,
        public string $phone = '',
        public string $postalCode = '',
        public string $state = '',
        public array $extra = [],
    ) {}

    public function displayName(string $language = 'en'): string
    {
        return $this->name?->display($language) ?? $this->code;
    }

    public function fullAddress(string $language = 'en'): string
    {
        $parts = array_filter([
            $this->address?->display($language),
            $this->buildingNumber,
            $this->district?->display($language),
            $this->city?->display($language),
            $this->postalCode,
            $this->state,
        ]);

        return implode(', ', array_map('strval', $parts));
    }
}
