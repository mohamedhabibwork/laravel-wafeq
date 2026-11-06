<?php

namespace HWafeq\LaravelWafeq\Exceptions;

/**
 * Thrown when a ZATCA request is rejected with 400: the payload is invalid,
 * failed ZATCA business rules, or duplicates an existing document.
 *
 * Extends {@see ValidationException} so existing `catch` blocks keep working.
 * ZATCA reports errors as a list: `[{code, detail, attr}, ...]`.
 */
class ZatcaValidationException extends ValidationException
{
    /**
     * @return array<int, array{code?: string, detail?: string, attr?: string|null}>
     */
    public function zatcaErrors(): array
    {
        $errors = $this->context()['errors'] ?? [];

        return is_array($errors) ? array_values(array_filter($errors, 'is_array')) : [];
    }
}
