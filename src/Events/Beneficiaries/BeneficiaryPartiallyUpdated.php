<?php

namespace HWafeq\LaravelWafeq\Events\Beneficiaries;

use HWafeq\LaravelWafeq\Data\BeneficiaryData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BeneficiaryData $data
 *
 * BeneficiaryPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Beneficiaries resource.
 *
 * @see LaravelWafeq
 */
class BeneficiaryPartiallyUpdated extends WafeqEvent {}
