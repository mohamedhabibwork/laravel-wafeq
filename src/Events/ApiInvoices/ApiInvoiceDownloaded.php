<?php

namespace HWafeq\LaravelWafeq\Events\ApiInvoices;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiInvoiceData $data
 *
 * ApiInvoiceDownloaded Event.
 *
 * Dispatched after a successful "Downloaded" call on the ApiInvoices resource.
 *
 * @see LaravelWafeq
 */
class ApiInvoiceDownloaded extends WafeqEvent {}
