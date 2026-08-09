<?php

namespace HWafeq\LaravelWafeq\Events\BankAccounts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankAccountData $data
 *
 * BankAccountCreated Event.
 *
 * Dispatched after a successful "Created" call on the BankAccounts resource.
 *
 * @see LaravelWafeq
 */
class BankAccountCreated extends WafeqEvent {}
