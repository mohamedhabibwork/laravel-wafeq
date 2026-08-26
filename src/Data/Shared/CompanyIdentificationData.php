<?php

namespace HWafeq\LaravelWafeq\Data\Shared;

use Spatie\LaravelData\Data;

/**
 * @property string $type
 * @property string $value
 *
 * One of the company-identification entries attached to a contact
 * (mirrors Wafeq's `_CompanyIdentificationCustomer` schema: a `{type,
 * value}` pair). `type` is one of the `CompanyIdentificationCustomerType`
 * values (`CRN`, `GCC`, `IQA`, `MLS`, `SAG`, `MOM`, `NAT`, `700`,
 * `OTH`, `PAS`, `TIN`, `TRD`); `value` is the actual identifier
 * string (e.g. CRN number, tax ID, passport number).
 *
 * @see LaravelWafeq
 */
class CompanyIdentificationData extends Data
{
    public function __construct(
        public string $type = '',
        public string $value = '',
    ) {}
}
