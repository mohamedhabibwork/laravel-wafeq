<?php

namespace HWafeq\LaravelWafeq\Events\Accounts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AccountData $data
 *
 * AccountDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Accounts resource.
 *
 * @see LaravelWafeq
 */
class AccountDestroyed extends WafeqEvent {}
