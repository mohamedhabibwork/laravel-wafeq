<?php

namespace HWafeq\LaravelWafeq\Events\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceData $data
 *
 * InvoiceCreated Event.
 *
 * Dispatched after a successful "Created" call on the Invoices resource.
 *
 * @see LaravelWafeq
 */
class InvoiceCreated extends WafeqEvent {}
