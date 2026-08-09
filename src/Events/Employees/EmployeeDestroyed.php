<?php

namespace HWafeq\LaravelWafeq\Events\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property EmployeeData $data
 *
 * EmployeeDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Employees resource.
 *
 * @see LaravelWafeq
 */
class EmployeeDestroyed extends WafeqEvent {}
