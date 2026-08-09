<?php

namespace HWafeq\LaravelWafeq\Events\BankStatementTransactions;

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankStatementTransactionData $data
 *
 * BankStatementTransactionCreated Event.
 *
 * Dispatched after a successful "Created" call on the BankStatementTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankStatementTransactionCreated extends WafeqEvent {}
