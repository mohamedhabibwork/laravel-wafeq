<?php

namespace HWafeq\LaravelWafeq\Exceptions;

use RuntimeException;

/**
 * WafeqException Exception.
 *
 * @see LaravelWafeq
 */
class WafeqException extends RuntimeException
{
    /**
     * @param  array<string, mixed>  $context
     */
    public function __construct(
        string $message,
        public readonly int $statusCode = 0,
        public readonly array $context = [],
    ) {
        parent::__construct($message);
    }

    /**
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return $this->context;
    }
}
