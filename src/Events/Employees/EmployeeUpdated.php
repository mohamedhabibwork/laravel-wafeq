<?php

namespace HWafeq\LaravelWafeq\Events\Employees;

use HWafeq\LaravelWafeq\Data\EmployeeData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property EmployeeData $data
 *
 * EmployeeUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Employees resource.
 *
 * @see LaravelWafeq
 */
class EmployeeUpdated extends WafeqEvent {}
