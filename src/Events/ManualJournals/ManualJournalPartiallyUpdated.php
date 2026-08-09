<?php

namespace HWafeq\LaravelWafeq\Events\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ManualJournalData $data
 *
 * ManualJournalPartiallyUpdated Event.
 *
 * Dispatched after a successful "PartiallyUpdated" call on the ManualJournals resource.
 *
 * @see LaravelWafeq
 */
class ManualJournalPartiallyUpdated extends WafeqEvent {}
