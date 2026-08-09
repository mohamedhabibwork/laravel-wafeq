<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteData $data
 *
 * CreditNoteUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the CreditNotes resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteUpdated extends WafeqEvent {}
