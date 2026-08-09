<?php

namespace HWafeq\LaravelWafeq\Events\ApiInvoices;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ApiInvoiceData $data
 *
 * ApiInvoicePartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the ApiInvoices resource.
 *
 * @see LaravelWafeq
 */
class ApiInvoicePartiallyUpdated extends WafeqEvent {}
