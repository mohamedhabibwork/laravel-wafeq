<?php

namespace HWafeq\LaravelWafeq\Events\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property EmployeeData $data
 *
 * EmployeeRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Employees resource.
 *
 * @see LaravelWafeq
 */
class EmployeeRetrieved extends WafeqEvent {}
