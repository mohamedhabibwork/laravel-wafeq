<?php

namespace HWafeq\LaravelWafeq\Exceptions;

/**
 * Thrown when the Wafeq API returns 401 or 403 (invalid or missing API key).
 *
 * @method static self fromStatus(int $statusCode, string $message, array<string, mixed> $context = [])
 */
/**
 * AuthenticationException Exception.
 *
 * @see LaravelWafeq
 */
class AuthenticationException extends WafeqException
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
