<?php

namespace HWafeq\LaravelWafeq\Events\ApiCreditNotes;

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiCreditNoteData $data
 *
 * ApiCreditNoteDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the ApiCreditNotes resource.
 *
 * @see LaravelWafeq
 */
class ApiCreditNoteDownloaded extends WafeqEvent {}
