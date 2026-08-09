<?php

namespace HWafeq\LaravelWafeq\Events\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property EmployeeData $data
 *
 * EmployeeCreated Event.
 *
 * Dispatched after a successful "Created" call on the Employees resource.
 *
 * @see LaravelWafeq
 */
class EmployeeCreated extends WafeqEvent {}
