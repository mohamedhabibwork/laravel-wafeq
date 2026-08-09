<?php

namespace HWafeq\LaravelWafeq\Events\Beneficiaries;

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BeneficiaryData $data
 *
 * BeneficiaryDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Beneficiaries resource.
 *
 * @see LaravelWafeq
 */
class BeneficiaryDestroyed extends WafeqEvent {}
