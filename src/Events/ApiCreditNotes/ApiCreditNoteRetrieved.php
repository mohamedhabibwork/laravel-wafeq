<?php

namespace HWafeq\LaravelWafeq\Events\ApiCreditNotes;

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiCreditNoteData $data
 *
 * ApiCreditNoteRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the ApiCreditNotes resource.
 *
 * @see LaravelWafeq
 */
class ApiCreditNoteRetrieved extends WafeqEvent {}
