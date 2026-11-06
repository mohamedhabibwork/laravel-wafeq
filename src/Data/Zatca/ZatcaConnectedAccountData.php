<?php

namespace HWafeq\LaravelWafeq\Data\Zatca;

use Spatie\LaravelData\Data;

/**
 * A customer a platform / white-label integration reports on behalf of.
 *
 * Mirrors the Wafeq ZATCA `connected-account-read` schema.
 *
 * @see https://docs.wafeq.com/zatca/for-platforms-or-white-label
 */
class ZatcaConnectedAccountData extends Data
{
    public function __construct(
        public string $id = '',
        public string $name = '',
        public string $address = '',
        public string $city = '',
        public string $country = '',
        public string $businessCategory = '',
        public string $taxRegistrationNumber = '',
    ) {}
}
