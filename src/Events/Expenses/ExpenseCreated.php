<?php

namespace HWafeq\LaravelWafeq\Events\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ExpenseData $data
 *
 * ExpenseCreated Event.
 *
 * Dispatched after a successful "Created" call on the Expenses resource.
 *
 * @see LaravelWafeq
 */
class ExpenseCreated extends WafeqEvent {}
