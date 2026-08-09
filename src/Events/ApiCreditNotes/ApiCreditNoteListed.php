<?php

namespace HWafeq\LaravelWafeq\Events\ApiCreditNotes;

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiCreditNoteData $data
 *
 * ApiCreditNoteListed Event.
 *
 * Dispatched after a successful "Listed" call on the ApiCreditNotes resource.
 *
 * @see LaravelWafeq
 */
class ApiCreditNoteListed extends WafeqEvent {}
