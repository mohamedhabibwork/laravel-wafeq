<?php

namespace HWafeq\LaravelWafeq\Events\Files;

use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property FileData $data
 *
 * FileDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the Files resource.
 *
 * @see LaravelWafeq
 */
class FileDestroyed extends WafeqEvent {}
