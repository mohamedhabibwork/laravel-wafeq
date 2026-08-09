<?php

namespace HWafeq\LaravelWafeq\Events\CostCenters;

use HWafeq\LaravelWafeq\Data\CostCenterData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CostCenterData $data
 *
 * CostCenterListed Event.
 *
 * Dispatched after a successful "Listed" call on the CostCenters resource.
 *
 * @see LaravelWafeq
 */
class CostCenterListed extends WafeqEvent {}
