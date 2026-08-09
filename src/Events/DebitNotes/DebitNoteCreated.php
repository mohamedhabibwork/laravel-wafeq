<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteData $data
 *
 * DebitNoteCreated Event.
 *
 * Dispatched after a successful "Created" call on the DebitNotes resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteCreated extends WafeqEvent {}
