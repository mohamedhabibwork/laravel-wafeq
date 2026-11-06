<?php

namespace HWafeq\LaravelWafeq\Events\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ZatcaDocumentData $data
 *
 * ZatcaDocumentReported Event.
 *
 * Dispatched after a document is reported / cleared with ZATCA synchronously.
 *
 * @see LaravelWafeq
 */
class ZatcaDocumentReported extends WafeqEvent {}
