<?php

namespace HWafeq\LaravelWafeq\Events\BankLedgerTransactions;

use HWafeq\LaravelWafeq\Data\BankLedgerTransactionData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankLedgerTransactionData $data
 *
 * BankLedgerTransactionRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the BankLedgerTransactions resource.
 *
 * @see LaravelWafeq
 */
class BankLedgerTransactionRetrieved extends WafeqEvent {}
