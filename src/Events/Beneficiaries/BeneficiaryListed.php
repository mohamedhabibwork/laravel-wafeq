<?php

namespace HWafeq\LaravelWafeq\Events\Beneficiaries;

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BeneficiaryData $data
 *
 * BeneficiaryListed Event.
 *
 * Dispatched after a successful "Listed" call on the Beneficiaries resource.
 *
 * @see LaravelWafeq
 */
class BeneficiaryListed extends WafeqEvent {}
