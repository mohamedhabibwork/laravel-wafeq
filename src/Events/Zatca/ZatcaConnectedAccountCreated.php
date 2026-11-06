<?php

namespace HWafeq\LaravelWafeq\Events\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\ZatcaConnectedAccountData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ZatcaConnectedAccountData $data
 *
 * ZatcaConnectedAccountCreated Event.
 *
 * Dispatched after a platform creates a connected account for one of its customers.
 *
 * @see LaravelWafeq
 */
class ZatcaConnectedAccountCreated extends WafeqEvent {}
