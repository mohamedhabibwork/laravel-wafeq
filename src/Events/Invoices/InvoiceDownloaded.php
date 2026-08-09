<?php

namespace HWafeq\LaravelWafeq\Events\Invoices;

use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property InvoiceData $data
 *
 * InvoiceDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the Invoices resource.
 *
 * @see LaravelWafeq
 */
class InvoiceDownloaded extends WafeqEvent {}
