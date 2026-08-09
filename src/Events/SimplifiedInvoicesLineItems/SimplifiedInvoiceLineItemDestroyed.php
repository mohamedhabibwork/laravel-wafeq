<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceLineItemData $data
 *
 * SimplifiedInvoiceLineItemDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the SimplifiedInvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceLineItemDestroyed extends WafeqEvent {}
