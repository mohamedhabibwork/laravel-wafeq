<?php

namespace HWafeq\LaravelWafeq\Events\Contacts;

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ContactData $data
 *
 * ContactListed Event.
 *
 * Dispatched after a successful "Listed" call on the Contacts resource.
 *
 * @see LaravelWafeq
 */
class ContactListed extends WafeqEvent {}
