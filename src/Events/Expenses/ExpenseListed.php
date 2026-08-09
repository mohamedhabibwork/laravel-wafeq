<?php

namespace HWafeq\LaravelWafeq\Events\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ExpenseData $data
 *
 * ExpenseListed Event.
 *
 * Dispatched after a successful "Listed" call on the Expenses resource.
 *
 * @see LaravelWafeq
 */
class ExpenseListed extends WafeqEvent {}
