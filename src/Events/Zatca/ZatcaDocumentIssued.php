<?php

namespace HWafeq\LaravelWafeq\Events\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDocumentData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ZatcaDocumentData $data
 *
 * ZatcaDocumentIssued Event.
 *
 * Dispatched after a simplified document is issued and its ZATCA reporting is queued.
 *
 * @see LaravelWafeq
 */
class ZatcaDocumentIssued extends WafeqEvent {}
