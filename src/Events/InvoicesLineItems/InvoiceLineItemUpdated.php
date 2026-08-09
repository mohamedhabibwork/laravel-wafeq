<?php

namespace HWafeq\LaravelWafeq\Events\InvoicesLineItems;

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceLineItemData $data
 *
 * InvoiceLineItemUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the InvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class InvoiceLineItemUpdated extends WafeqEvent {}
