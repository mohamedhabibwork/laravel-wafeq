<?php

namespace HWafeq\LaravelWafeq\Events\BankAccounts;

use HWafeq\LaravelWafeq\Data\BankAccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property BankAccountData $data
 *
 * BankAccountUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the BankAccounts resource.
 *
 * @see LaravelWafeq
 */
class BankAccountUpdated extends WafeqEvent {}
