<?php

namespace HWafeq\LaravelWafeq\Events\CreditNotesLineItems;

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property CreditNoteLineItemData $data
 *
 * CreditNoteLineItemDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the CreditNotesLineItems resource.
 *
 * @see LaravelWafeq
 */
class CreditNoteLineItemDestroyed extends WafeqEvent {}
