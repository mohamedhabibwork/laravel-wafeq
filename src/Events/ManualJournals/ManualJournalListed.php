<?php

namespace HWafeq\LaravelWafeq\Events\ManualJournals;

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Events\Concerns\WafeqEvent;

/**
 * @property ManualJournalData $data
 *
 * ManualJournalListed Event.
 *
 * Dispatched after a successful "Listed" call on the ManualJournals resource.
 *
 * @see LaravelWafeq
 */
class ManualJournalListed extends WafeqEvent {}
