<?php

namespace HWafeq\LaravelWafeq\Events\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ContactData $data
 *
 * ContactPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the Contacts resource.
 *
 * @see LaravelWafeq
 */
class ContactPartiallyUpdated extends WafeqEvent {}
