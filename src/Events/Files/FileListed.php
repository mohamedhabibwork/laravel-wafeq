<?php

namespace HWafeq\LaravelWafeq\Events\Files;

use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property FileData $data
 *
 * FileListed Event.
 *
 * Dispatched after a successful "Listed" call on the Files resource.
 *
 * @see LaravelWafeq
 */
class FileListed extends WafeqEvent {}
