<?php

namespace HWafeq\LaravelWafeq\Events\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ExpenseData $data
 *
 * ExpenseDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Expenses resource.
 *
 * @see LaravelWafeq
 */
class ExpenseDestroyed extends WafeqEvent {}
