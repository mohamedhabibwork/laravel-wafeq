<?php

namespace HWafeq\LaravelWafeq\Events\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CostCenterData $data
 *
 * CostCenterPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the CostCenters resource.
 *
 * @see LaravelWafeq
 */
class CostCenterPartiallyUpdated extends WafeqEvent {}
