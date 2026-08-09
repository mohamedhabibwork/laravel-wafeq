<?php

namespace HWafeq\LaravelWafeq\Events\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CostCenterData $data
 *
 * CostCenterRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the CostCenters resource.
 *
 * @see LaravelWafeq
 */
class CostCenterRetrieved extends WafeqEvent {}
