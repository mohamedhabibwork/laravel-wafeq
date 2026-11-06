<?php

namespace HWafeq\LaravelWafeq\Events\Zatca;

use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDeviceData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ZatcaDeviceData $data
 *
 * ZatcaDeviceRegistered Event.
 *
 * Dispatched after a device is registered with ZATCA using a Fatoora portal OTP.
 *
 * @see LaravelWafeq
 */
class ZatcaDeviceRegistered extends WafeqEvent {}
