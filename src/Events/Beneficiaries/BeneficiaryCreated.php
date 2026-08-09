<?php

namespace HWafeq\LaravelWafeq\Events\Beneficiaries;

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BeneficiaryData $data
 *
 * BeneficiaryCreated Event.
 *
 * Dispatched after a successful "Created" call on the Beneficiaries resource.
 *
 * @see LaravelWafeq
 */
class BeneficiaryCreated extends WafeqEvent {}
