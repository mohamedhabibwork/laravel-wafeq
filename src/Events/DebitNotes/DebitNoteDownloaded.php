<?php

namespace HWafeq\LaravelWafeq\Events\DebitNotes;

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property DebitNoteData $data
 *
 * DebitNoteDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the DebitNotes resource.
 *
 * @see LaravelWafeq
 */
class DebitNoteDownloaded extends WafeqEvent {}
