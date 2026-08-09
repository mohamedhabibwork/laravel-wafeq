<?php

namespace HWafeq\LaravelWafeq\Events\SimplifiedInvoices;

use HWafeq\LaravelWafeq\Data\SimplifiedInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property SimplifiedInvoiceData $data
 *
 * SimplifiedInvoiceDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the SimplifiedInvoices resource.
 *
 * @see LaravelWafeq
 */
class SimplifiedInvoiceDownloaded extends WafeqEvent {}
