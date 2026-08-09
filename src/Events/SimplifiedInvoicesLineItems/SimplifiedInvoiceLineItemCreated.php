<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceLineItemData $data
 *
 * SimplifiedInvoiceLineItemCreated Event.
 *
 * Dispatched after a successful "Created" call on the SimplifiedInvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceLineItemCreated extends WafeqEvent {}
