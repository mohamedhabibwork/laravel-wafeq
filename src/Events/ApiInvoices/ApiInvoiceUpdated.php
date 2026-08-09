<?php

namespace HWafeq\LaravelWafeq\Events\ApiInvoices;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiInvoiceData $data
 *
 * ApiInvoiceUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the ApiInvoices resource.
 *
 * @see LaravelWafeq
 */
class ApiInvoiceUpdated extends WafeqEvent {}
