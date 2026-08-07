<?php

namespace HWafeq\LaravelWafeq\Exceptions;

/**
 * Thrown when the Wafeq API returns 429 (rate limit exceeded).
 *
 * @method static self fromStatus(int $statusCode, string $message, array<string, mixed> $context = [])
 */
/**
 * RateLimitException Exception.
 *
 * @see LaravelWafeq
 */
class RateLimitException extends WafeqException
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

    /**
     * Number of seconds the client should wait before retrying, or null.
     */
    public function retryAfter(): ?int
    {
        $value = $this->context()['retry_after'] ?? null;

        return $value === null ? null : (int) $value;
    }
}
