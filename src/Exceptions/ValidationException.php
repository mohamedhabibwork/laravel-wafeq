<?php

namespace HWafeq\LaravelWafeq\Exceptions;

/**
 * Thrown when the Wafeq API returns 422 (validation error).
 */
/**
 * ValidationException Exception.
 *
 * @see LaravelWafeq
 */
class ValidationException extends WafeqException
{
    /**
     * @return array<string, array<int, string>>
     */
    public function errors(): array
    {
        $errors = $this->context()['errors'] ?? [];

        return is_array($errors) ? $errors : [];
    }
}
