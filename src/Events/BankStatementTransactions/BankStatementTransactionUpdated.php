<?php

namespace HWafeq\LaravelWafeq\Events\BankStatementTransactions;

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankStatementTransactionData $data
 *
 * BankStatementTransactionUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the BankStatementTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankStatementTransactionUpdated extends WafeqEvent {}
