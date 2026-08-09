<?php

namespace HWafeq\LaravelWafeq\Events\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ManualJournalData $data
 *
 * ManualJournalUpdated Event.
 *
 * Dispatched after a successful "Updated" call on the ManualJournals resource.
 *
 * @see LaravelWafeq
 */
class ManualJournalUpdated extends WafeqEvent {}
