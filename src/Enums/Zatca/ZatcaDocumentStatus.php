<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * Reporting status of a ZATCA document.
 *
 * Documents in `Error` are retried automatically every hour and can be
 * retried manually through the `retry` endpoint.
 */
enum ZatcaDocumentStatus: string
{
    case Error = 'ERROR';
    case Failed = 'FAILED';
    case Pending = 'PENDING';
    case Processing = 'PROCESSING';
    case Queued = 'QUEUED';
    case Reported = 'REPORTED';

    /**
     * Whether ZATCA has not accepted the document (yet).
     */
    public function isUnsuccessful(): bool
    {
        return $this === self::Error || $this === self::Failed;
    }

    /**
     * Whether reporting is still in flight.
     */
    public function isInProgress(): bool
    {
        return match ($this) {
            self::Pending, self::Processing, self::Queued => true,
            default => false,
        };
    }
}
