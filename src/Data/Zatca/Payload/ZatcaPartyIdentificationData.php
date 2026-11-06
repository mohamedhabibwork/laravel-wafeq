<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaCustomerIdentificationType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaSupplierIdentificationType;

/**
 * An additional party identifier, e.g. a commercial registration number.
 *
 * `type` is a {@see ZatcaSupplierIdentificationType} or
 * {@see ZatcaCustomerIdentificationType} code.
 */
class ZatcaPartyIdentificationData extends ZatcaPayloadData
{
    public function __construct(
        public string $type,
        public string $value,
    ) {}

    public static function supplier(ZatcaSupplierIdentificationType $type, string $value): self
    {
        return new self($type->value, $value);
    }

    public static function customer(ZatcaCustomerIdentificationType $type, string $value): self
    {
        return new self($type->value, $value);
    }

    public static function commercialRegistration(string $crn): self
    {
        return new self(ZatcaSupplierIdentificationType::CommercialRegistration->value, $crn);
    }
}
