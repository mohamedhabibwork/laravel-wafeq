<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotesLineItems;

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteLineItemData $data
 *
 * CreditNoteLineItemCreated Event.
 *
 * Dispatched after a successful "Created" call on the CreditNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteLineItemCreated extends WafeqEvent {}
