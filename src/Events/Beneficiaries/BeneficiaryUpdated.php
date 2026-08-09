<?php

namespace HWafeq\LaravelWafeq\Events\Beneficiaries;

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BeneficiaryData $data
 *
 * BeneficiaryUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Beneficiaries resource.
 *
 * @see LaravelWafeq
 */
class BeneficiaryUpdated extends WafeqEvent {}
