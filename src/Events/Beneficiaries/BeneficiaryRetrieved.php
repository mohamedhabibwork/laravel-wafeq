<?php

namespace HWafeq\LaravelWafeq\Events\Beneficiaries;

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BeneficiaryData $data
 *
 * BeneficiaryRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Beneficiaries resource.
 *
 * @see LaravelWafeq
 */
class BeneficiaryRetrieved extends WafeqEvent {}
