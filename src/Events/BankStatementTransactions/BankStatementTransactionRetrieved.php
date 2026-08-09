<?php

namespace HWafeq\LaravelWafeq\Events\BankStatementTransactions;

use HWafeq\LaravelWafeq\Data\BankStatementTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankStatementTransactionData $data
 *
 * BankStatementTransactionRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the BankStatementTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankStatementTransactionRetrieved extends WafeqEvent {}
