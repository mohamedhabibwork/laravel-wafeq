<?php

namespace HWafeq\LaravelWafeq\Events\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceData $data
 *
 * InvoiceDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Invoices resource.
 *
 * @see LaravelWafeq
 */
class InvoiceDestroyed extends WafeqEvent {}
