<?php

namespace HWafeq\LaravelWafeq\Events\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceData $data
 *
 * InvoiceRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Invoices resource.
 *
 * @see LaravelWafeq
 */
class InvoiceRetrieved extends WafeqEvent {}
