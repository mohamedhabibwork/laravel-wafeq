<?php

namespace HWafeq\LaravelWafeq\Exceptions;

/**
 * Thrown when the requested Wafeq resource does not exist (404).
 *
 * @method static self fromStatus(int $statusCode, string $message, array<string, mixed> $context = [])
 */
/**
 * NotFoundException Exception.
 *
 * @see LaravelWafeq
 */
class NotFoundException extends WafeqException
{
    /**
     * Construct an exception from a known HTTP status.
     *
     * @param  array<string, mixed>  $context
     */
    public static function fromStatus(int $statusCode, string $message, array $context = []): self
    {
        return new self($message, $statusCode, $context);
    }
}
