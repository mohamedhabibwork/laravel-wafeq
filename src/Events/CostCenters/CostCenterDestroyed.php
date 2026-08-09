<?php

namespace HWafeq\LaravelWafeq\Events\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CostCenterData $data
 *
 * CostCenterDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the CostCenters resource.
 *
 * @see LaravelWafeq
 */
class CostCenterDestroyed extends WafeqEvent {}
