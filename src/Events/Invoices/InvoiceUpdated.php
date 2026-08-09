<?php

namespace HWafeq\LaravelWafeq\Events\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceData $data
 *
 * InvoiceUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the Invoices resource.
 *
 * @see LaravelWafeq
 */
class InvoiceUpdated extends WafeqEvent {}
