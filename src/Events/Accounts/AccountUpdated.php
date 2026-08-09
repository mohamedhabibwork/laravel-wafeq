<?php

namespace HWafeq\LaravelWafeq\Events\Accounts;

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property AccountData $data
 *
 * AccountUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Accounts resource.
 *
 * @see LaravelWafeq
 */
class AccountUpdated extends WafeqEvent {}
