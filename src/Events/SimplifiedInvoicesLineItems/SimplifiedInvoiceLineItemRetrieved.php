<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoicesLineItems;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceLineItemData $data
 *
 * SimplifiedInvoiceLineItemRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the SimplifiedInvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceLineItemRetrieved extends WafeqEvent {}
