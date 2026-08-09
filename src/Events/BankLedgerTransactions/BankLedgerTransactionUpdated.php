<?php

namespace HWafeq\LaravelWafeq\Events\BankLedgerTransactions;

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankLedgerTransactionData $data
 *
 * BankLedgerTransactionUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the BankLedgerTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankLedgerTransactionUpdated extends WafeqEvent {}
