<?php

namespace HWafeq\LaravelWafeq\Exceptions;

/**
 * Thrown when Wafeq could not report / clear a document with ZATCA (424).
 *
 * The document payload was accepted by Wafeq but the tax authority call
 * failed. The `errors` list in {@see self::context()} carries ZATCA's reasons.
 */
class ZatcaSubmissionException extends WafeqException
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
