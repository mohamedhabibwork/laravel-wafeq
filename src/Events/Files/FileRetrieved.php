<?php

namespace HWafeq\LaravelWafeq\Events\Files;

use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property FileData $data
 *
 * FileRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the Files resource.
 *
 * @see LaravelWafeq
 */
class FileRetrieved extends WafeqEvent {}
