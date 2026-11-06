<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * A registered item code, e.g. `new ZatcaStandardItemIdentifierData('GTIN', '0123…')`.
 */
class ZatcaStandardItemIdentifierData extends ZatcaPayloadData
{
    public function __construct(
        public string $scheme,
        public string $value,
    ) {}
}
