<?php

namespace HWafeq\LaravelWafeq\Events\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ManualJournalData $data
 *
 * ManualJournalRetrieved Event.
 *
 * Dispatched after a successful "Retrieved" call on the ManualJournals resource.
 *
 * @see LaravelWafeq
 */
class ManualJournalRetrieved extends WafeqEvent {}
