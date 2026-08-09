<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotesLineItems;

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteLineItemData $data
 *
 * CreditNoteLineItemUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the CreditNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteLineItemUpdated extends WafeqEvent {}
