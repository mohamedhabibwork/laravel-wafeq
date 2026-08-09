<?php

namespace HWafeq\LaravelWafeq\Events\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CostCenterData $data
 *
 * CostCenterCreated Event.
 *
 * Dispatched after a successful "Created" call on the CostCenters resource.
 *
 * @see LaravelWafeq
 */
class CostCenterCreated extends WafeqEvent {}
