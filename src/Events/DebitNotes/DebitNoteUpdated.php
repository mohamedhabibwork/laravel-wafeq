<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteData $data
 *
 * DebitNoteUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the DebitNotes resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteUpdated extends WafeqEvent {}
