<?php

namespace HWafeq\LaravelWafeq\Events\ApiCreditNotes;

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiCreditNoteData $data
 *
 * ApiCreditNotePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the ApiCreditNotes resource.
 *
 * @see LaravelWafeq
 */
class ApiCreditNotePartiallyUpdated extends WafeqEvent {}
