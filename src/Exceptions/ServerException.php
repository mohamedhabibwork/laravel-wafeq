<?php

namespace HWafeq\LaravelWafeq\Exceptions;

/**
 * Thrown when the Wafeq API returns a 5xx server error.
 *
 * @method static self fromStatus(int $statusCode, string $message, array<string, mixed> $context = [])
 */
/**
 * ServerException Exception.
 *
 * @see LaravelWafeq
 */
class ServerException extends WafeqException
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
