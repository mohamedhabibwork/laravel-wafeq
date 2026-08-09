<?php

namespace HWafeq\LaravelWafeq\Events\Accounts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AccountData $data
 *
 * AccountCreated Event.
 *
 * Dispatched after a successful "Created" call on the Accounts resource.
 *
 * @see LaravelWafeq
 */
class AccountCreated extends WafeqEvent {}
