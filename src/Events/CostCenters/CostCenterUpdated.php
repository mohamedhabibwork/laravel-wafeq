<?php

namespace HWafeq\LaravelWafeq\Events\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CostCenterData $data
 *
 * CostCenterUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the CostCenters resource.
 *
 * @see LaravelWafeq
 */
class CostCenterUpdated extends WafeqEvent {}
