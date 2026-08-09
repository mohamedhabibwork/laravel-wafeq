<?php

namespace HWafeq\LaravelWafeq\Events\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ContactData $data
 *
 * ContactDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Contacts resource.
 *
 * @see LaravelWafeq
 */
class ContactDestroyed extends WafeqEvent {}
