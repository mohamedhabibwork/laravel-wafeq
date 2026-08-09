<?php

namespace HWafeq\LaravelWafeq\Events\Files;

use HWafeq\LaravelWafeq\Data\FileData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property FileData $data
 *
 * FileUploadedRaw Event.
 *
 * Dispatched after a successful "UploadedRaw" call on the Files resource.
 *
 * @see LaravelWafeq
 */
class FileUploadedRaw extends WafeqEvent {}
