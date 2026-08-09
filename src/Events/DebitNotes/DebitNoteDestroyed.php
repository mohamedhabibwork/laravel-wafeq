<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteData $data
 *
 * DebitNoteDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the DebitNotes resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteDestroyed extends WafeqEvent {}
