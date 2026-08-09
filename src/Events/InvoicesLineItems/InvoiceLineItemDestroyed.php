<?php

namespace HWafeq\LaravelWafeq\Events\InvoicesLineItems;

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceLineItemData $data
 *
 * InvoiceLineItemDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the InvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class InvoiceLineItemDestroyed extends WafeqEvent {}
