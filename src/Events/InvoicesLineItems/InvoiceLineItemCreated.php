<?php

namespace HWafeq\LaravelWafeq\Events\InvoicesLineItems;

use HWafeq\LaravelWafeq\Data\InvoiceLineItemData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceLineItemData $data
 *
 * InvoiceLineItemCreated Event.
 *
 * Dispatched after a successful "Created" call on the InvoicesLineItems resource.
 *
 * @see LaravelWafeq
 */
class InvoiceLineItemCreated extends WafeqEvent {}
