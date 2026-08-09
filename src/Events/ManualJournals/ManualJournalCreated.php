<?php

namespace HWafeq\LaravelWafeq\Events\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ManualJournalData $data
 *
 * ManualJournalCreated Event.
 *
 * Dispatched after a successful "Created" call on the ManualJournals resource.
 *
 * @see LaravelWafeq
 */
class ManualJournalCreated extends WafeqEvent {}
