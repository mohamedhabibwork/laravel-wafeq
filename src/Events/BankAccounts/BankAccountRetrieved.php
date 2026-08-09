<?php

namespace HWafeq\LaravelWafeq\Events\BankAccounts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankAccountData $data
 *
 * BankAccountRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the BankAccounts resource.
 *
 * @see LaravelWafeq
 */
class BankAccountRetrieved extends WafeqEvent {}
