<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * Metadata changes to merge into a ZATCA document; `null` removes a key.
 */
class ZatcaMetadataUpdateData extends ZatcaPayloadData
{
    /**
     * @param  array<string, string|null>  $metadata
     */
    public function __construct(
        public array $metadata = [],
    ) {}
}
