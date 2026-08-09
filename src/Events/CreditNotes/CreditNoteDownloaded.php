<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotes;

use HWafeq\LaravelWafeq\Data\CreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteData $data
 *
 * CreditNoteDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the CreditNotes resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteDownloaded extends WafeqEvent {}
