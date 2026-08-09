<?php

namespace HWafeq\LaravelWafeq\Events\Files;

use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property FileData $data
 *
 * FileUploaded Event.
 *
 * Dispatched after a successful "Uploaded" call on the Files resource.
 *
 * @see LaravelWafeq
 */
class FileUploaded extends WafeqEvent {}
