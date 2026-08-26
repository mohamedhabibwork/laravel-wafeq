<?php

namespace HWafeq\LaravelWafeq\Events\Expenses;

use HWafeq\LaravelWafeq\Data\ExpenseData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ExpenseData $data
 *
 * ExpenseMarkedAsDraft Event.
 *
 * Dispatched after a successful "Mark expense as draft" call on the Expenses
 * resource — moves a posted expense back to draft (removes its journal from
 * the ledger).
 *
 * @see LaravelWafeq
 */
class ExpenseMarkedAsDraft extends WafeqEvent {}
