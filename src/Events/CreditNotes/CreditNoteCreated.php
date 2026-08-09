<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteData $data
 *
 * CreditNoteCreated Event.
 *
 * Dispatched after a successful "Created" call on the CreditNotes resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteCreated extends WafeqEvent {}
