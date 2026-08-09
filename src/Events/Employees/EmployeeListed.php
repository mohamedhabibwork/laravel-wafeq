<?php

namespace HWafeq\LaravelWafeq\Events\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property EmployeeData $data
 *
 * EmployeeListed Event.
 *
 * Dispatched after a successful "Listed" call on the Employees resource.
 *
 * @see LaravelWafeq
 */
class EmployeeListed extends WafeqEvent {}
