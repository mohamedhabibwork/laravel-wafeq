<?php

namespace HWafeq\LaravelWafeq\Events\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ManualJournalData $data
 *
 * ManualJournalDestroyed Event.
 *
 * Dispatched after a successful "Destroyed" call on the ManualJournals resource.
 *
 * @see LaravelWafeq
 */
class ManualJournalDestroyed extends WafeqEvent {}
